<div class="tmpray-helper-dashboard wrap about-wrap">
    <a href="https://templines.com/portfolio/ihsan-islamic-center-wordpress-theme/">
        <div class="tmpray-banner"></div>
    </a>
    <div class="tmpray-helper-dashboard-info-box cf">
        <h3 class="tmpray-helper-dashboard_title"><?php echo esc_html('Pray Time', 'tmpray-islamic-helper');?></h3>

        <p class="">
            <a target="_blank" href="<?php echo tmpray_dashboard()->strings['theme_link']; ?>" class="button button-secondary tmpray-helper-admin-btn"><?php echo tmpray_dashboard()->strings['theme_text']; ?></a>
            <a target="_blank" href="<?php echo tmpray_dashboard()->strings['subscribe_link']; ?>" class="button button-secondary tmpray-helper-admin-btn"><?php echo tmpray_dashboard()->strings['subscribe_text']; ?></a>
            <a target="_blank" href="<?php echo tmpray_dashboard()->strings['support_link']; ?>" class="button button-primary tmpray-helper-admin-btn"><?php echo tmpray_dashboard()->strings['support_text']; ?></a>
            <a target="_blank" href="<?php echo tmpray_dashboard()->strings['documentation_link']; ?>" class="button button-primary tmpray-helper-admin-btn"><?php echo tmpray_dashboard()->strings['documentation_text']; ?></a>
        </p>

    </div>
    <div class="clear"></div>
    <div class="tmpray-helper-dashboard-nav cf">
        <a href="<?php echo admin_url('admin.php?page=tmpray_theme-dashboard'); ?>" class="nav-tab"><?php echo __('Pray Time','tmpray-islamic-helper'); ?> </a>
        <a href="<?php echo admin_url('admin.php?page=tmpray_shortcodes'); ?>" class="nav-tab nav-tab-active"><?php echo __('Shortcodes','tmpray-islamic-helper'); ?> </a>
    </div>
    <div class="tmpray--shortcodes">
        <div class="tmpray--shortcodes-contain">
            <h4><?php echo esc_html('Single Type', 'tmpray-islamic-helper');?></h4>

            <div class="tmpray--shortcodes-single">
                <div class="tmpray--shortcodes-single-contain">
                    <div class="tmpray-shortcodes-single-title-contain">
                        <input type="checkbox" id="tmpray--shortcodes-single-title-check" name="tmpray--shortcodes-single-title-check">
                        <label for="tmpray--shortcodes-single-title-check"><?php echo esc_html('Title', 'tmpray-islamic-helper');?></label>
                    </div>
                    <div class="tmpray-shortcodes-checkbox-contain">
                        <div>
                            <input type="checkbox" id="tmpray--shortcodes-fajr-check" name="tmpray--shortcodes-fajr-check">
                            <label for="tmpray--shortcodes-fajr-check"><?php echo esc_html('Fajr', 'tmpray-islamic-helper');?></label>

                        </div>
                        <div>
                            <input type="checkbox" id="tmpray--shortcodes-sunrise-check" name="tmpray--shortcodes-sunrise-check">
                            <label for="tmpray--shortcodes-sunrise-check"><?php echo esc_html('Sunrise', 'tmpray-islamic-helper');?></label>
                        </div>
                        <div>
                            <input type="checkbox" id="tmpray--shortcodes-dhuhr-check" name="tmpray--shortcodes-dhuhr-check">
                            <label for="tmpray--shortcodes-dhuhr-check"><?php echo esc_html('Dhuhr', 'tmpray-islamic-helper');?></label>
                        </div>
                        <div>
                            <input type="checkbox" id="tmpray--shortcodes-asr-check" name="tmpray--shortcodes-asr-check">
                            <label for="tmpray--shortcodes-asr-check"><?php echo esc_html('Asr', 'tmpray-islamic-helper');?></label>
                        </div>
                        <div>
                            <input type="checkbox" id="tmpray--shortcodes-maghrib-check" name="tmpray--shortcodes-maghrib-check">
                            <label for="tmpray--shortcodes-maghrib-check"><?php echo esc_html('Maghrib', 'tmpray-islamic-helper');?></label>
                        </div>
                        <div>
                            <input type="checkbox" id="tmpray--shortcodes-isha-check" name="tmpray--shortcodes-isha-check">
                            <label for="tmpray--shortcodes-isha-check"><?php echo esc_html('Isha', 'tmpray-islamic-helper');?></label>
                        </div>
                    </div>
                    <div class="tmpray-shortcodes-single-suf-pref-contain">
                        <label for="tmpray--shortcodes-single-pref"><?php echo esc_html('Preffix', 'tmpray-islamic-helper');?></label>
                        <input type="text" id="tmpray--shortcodes-single-pref" name="tmpray--shortcodes-single-pref">

                        <label for="tmpray--shortcodes-single-suf"><?php echo esc_html('Suffix', 'tmpray-islamic-helper');?></label>
                        <input type="text" id="tmpray--shortcodes-single-suf" name="tmpray--shortcodes-single-suf">

                        <button id="tmpray--shortcode-single-show"><?php echo esc_html('Show', 'tmpray-islamic-helper');?></button>
                    </div>
                </div>
                <div class="tmpray--shortcode-single-show">
                    <span id="tmpray--shortcode-single-name"></span>
                </div>
            </div>

            <h4><?php echo esc_html('All Type', 'tmpray-islamic-helper');?></h4>

            <div class="tmpray--shortcodes-all">
                <div class="tmpray--shortcodes-all-contain">
                    <div class="tmpray-shortcodes-title-contain">
                        <input type="checkbox" id="tmpray--shortcodes-title-check" name="tmpray--shortcodes-title-check">
                        <label for="tmpray--shortcodes-title-check"><?php echo esc_html('Title', 'tmpray-islamic-helper');?></label>
                    </div>
                    <div class="tmpray-shortcodes-suf-pref-contain">
                        <label for="tmpray--shortcodes-pref"><?php echo esc_html('Preffix', 'tmpray-islamic-helper');?></label>
                        <input type="text" id="tmpray--shortcodes-pref" name="tmpray--shortcodes-pref">

                        <label for="tmpray--shortcodes-suf"><?php echo esc_html('Suffix', 'tmpray-islamic-helper');?></label>
                        <input type="text" id="tmpray--shortcodes-suf" name="tmpray--shortcodes-suf">

                        <button id="tmpray--shortcode-all-show"><?php echo esc_html('Show', 'tmpray-islamic-helper');?></button>
                    </div>
                </div>

                <div class="tmpray--shortcode-all-show">
                    <span id="tmpray--shortcode-all-name"></span>
                </div>
            </div>
        </div>
        <div class="tmpray--shortcodes-preview">

        </div>
    </div>
</div>