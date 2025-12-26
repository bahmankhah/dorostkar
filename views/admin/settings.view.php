<?php
/**
 * صفحه تنظیمات دستیار هوشمند
 * رابط کاربری فارسی برای پیکربندی افزونه
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap dorostkar-admin" dir="rtl">
    <h1><?php echo esc_html($page_title); ?></h1>
    
    <div class="dorostkar-admin-header">
        <div class="dorostkar-logo">
            <h2><?php _e('تنظیمات دستیار هوشمند', 'dorostkar'); ?></h2>
            <div class="dorostkar-header-meta">
                <span class="dorostkar-current-date" data-tooltip-fa="<?php _e('تاریخ شمسی امروز', 'dorostkar'); ?>"></span>
                <span class="dorostkar-current-time" data-tooltip-fa="<?php _e('ساعت فعلی', 'dorostkar'); ?>"></span>
                <span class="dorostkar-version" data-tooltip-fa="<?php _e('نسخه افزونه', 'dorostkar'); ?>">
                    <?php _e('نسخه', 'dorostkar'); ?> ۱.۰.۰
                </span>
            </div>
        </div>
    </div>

    <form id="dorostkar-settings-form" method="post">
        <?php wp_nonce_field('dorostkar_settings', 'dorostkar_nonce'); ?>
        
        <div class="dorostkar-tab-content">
            <?php include __DIR__ . '/partials/aiagent-tab.view.php'; ?>
        </div>
    </form>

    <div id="dorostkar-messages" class="dorostkar-messages"></div>
</div>

<style>
.dorostkar-admin {
    font-family: 'Vazir', 'Tahoma', sans-serif;
}

.dorostkar-admin-header {
    background: #fff;
    border: 1px solid #ccd0d4;
    border-radius: 4px;
    padding: 20px;
    margin: 20px 0;
}

.dorostkar-logo h2 {
    color: #1e73be;
    margin: 0 0 10px 0;
}

.dorostkar-header-meta {
    margin-top: 15px;
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.dorostkar-header-meta span {
    background: rgba(30, 115, 190, 0.1);
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 12px;
    color: #1e73be;
    border: 1px solid rgba(30, 115, 190, 0.3);
}

.dorostkar-nav-tabs {
    margin-bottom: 0;
}

.dorostkar-tab-content {
    background: #fff;
    border: 1px solid #ccd0d4;
    border-top: none;
    padding: 20px;
    min-height: 400px;
}

.dorostkar-form-actions {
    margin-top: 20px;
    padding: 15px 20px;
    background: #f9f9f9;
    border: 1px solid #ccd0d4;
    border-radius: 4px;
}

.dorostkar-form-actions .button {
    margin-left: 10px;
}

.dorostkar-messages {
    margin-top: 20px;
}

.dorostkar-messages .notice {
    margin: 5px 0;
}

.form-table th {
    text-align: right;
    padding-right: 0;
    padding-left: 20px;
}

.form-table td {
    padding-left: 0;
}

.dorostkar-field-description {
    font-style: italic;
    color: #666;
    margin-top: 5px;
}

.dorostkar-template-variables {
    background: #f0f0f1;
    border: 1px solid #c3c4c7;
    border-radius: 4px;
    padding: 10px;
    margin-top: 10px;
}

.dorostkar-template-variables h4 {
    margin: 0 0 10px 0;
    color: #1d2327;
}

.dorostkar-template-variables code {
    background: #fff;
    padding: 2px 4px;
    border-radius: 2px;
    margin: 2px;
    display: inline-block;
}
</style>

<script>
jQuery(document).ready(function($) {
    // Handle form submission
    $('#dorostkar-settings-form').on('submit', function(e) {
        e.preventDefault();
        
        var $saveBtn = $('#dorostkar-save-btn');
        var $spinner = $('#dorostkar-save-spinner');
        
        // Show loading state
        $saveBtn.prop('disabled', true);
        $spinner.addClass('is-active');
        
        var formData = new FormData(this);
        formData.append('action', 'dorostkar_save_settings');
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    showMessage(response.data.message, 'success');
                } else {
                    showMessage(response.data.message, 'error');
                }
            },
            error: function() {
                showMessage('<?php _e("خطا در ارتباط با سرور", "dorostkar"); ?>', 'error');
            },
            complete: function() {
                // Hide loading state
                $saveBtn.prop('disabled', false);
                $spinner.removeClass('is-active');
            }
        });
    });
    
    // Handle reset settings
    $('#dorostkar-reset-settings').on('click', function() {
        if (confirm('<?php _e("آیا مطمئن هستید که می‌خواهید تمام تنظیمات را به حالت پیش‌فرض بازگردانید؟", "dorostkar"); ?>')) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'dorostkar_reset_settings',
                    nonce: $('#dorostkar_nonce').val()
                },
                success: function(response) {
                    if (response.success) {
                        showMessage(response.data.message, 'success');
                        location.reload();
                    } else {
                        showMessage(response.data.message, 'error');
                    }
                }
            });
        }
    });
    
    // Handle export settings
    $('#dorostkar-export-settings').on('click', function() {
        var settings = getFormSettings();
        var dataStr = JSON.stringify(settings, null, 2);
        var dataBlob = new Blob([dataStr], {type: 'application/json'});
        
        var link = document.createElement('a');
        link.href = URL.createObjectURL(dataBlob);
        link.download = 'dorostkar-settings-' + new Date().toISOString().split('T')[0] + '.json';
        link.click();
    });
    
    // Handle import settings
    $('#dorostkar-import-settings').on('click', function() {
        $('#dorostkar-import-file').click();
    });
    
    $('#dorostkar-import-file').on('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                try {
                    var settings = JSON.parse(e.target.result);
                    setFormSettings(settings);
                    showMessage('<?php _e("تنظیمات با موفقیت وارد شد", "dorostkar"); ?>', 'success');
                } catch (error) {
                    showMessage('<?php _e("فایل تنظیمات نامعتبر است", "dorostkar"); ?>', 'error');
                }
            };
            reader.readAsText(file);
        }
    });
    
    function showMessage(message, type) {
        var messageClass = type === 'success' ? 'notice-success' : 'notice-error';
        var messageHtml = '<div class="notice ' + messageClass + ' is-dismissible"><p>' + message + '</p></div>';
        $('#dorostkar-messages').html(messageHtml);
        
        setTimeout(function() {
            $('#dorostkar-messages .notice').fadeOut();
        }, 5000);
    }
    
    function getFormSettings() {
        var settings = {};
        $('#dorostkar-settings-form').find('input, select, textarea').each(function() {
            var $this = $(this);
            var name = $this.attr('name');
            if (name && name !== 'dorostkar_nonce' && name !== '_wp_http_referer') {
                if ($this.attr('type') === 'checkbox') {
                    settings[name] = $this.is(':checked');
                } else {
                    settings[name] = $this.val();
                }
            }
        });
        return settings;
    }
    
    function setFormSettings(settings) {
        $.each(settings, function(name, value) {
            var $field = $('#dorostkar-settings-form').find('[name="' + name + '"]');
            if ($field.length) {
                if ($field.attr('type') === 'checkbox') {
                    $field.prop('checked', value);
                } else {
                    $field.val(value);
                }
            }
        });
    }
});
</script>