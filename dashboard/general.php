<?php tmpray_add_json_data();?>




<div class="tmpray-helper-dashboard wrap about-wrap">
    <a href="https://templines.com/portfolio/ihsan-islamic-center-wordpress-theme/">
        <div class="tmpray-banner"></div>
    </a>
    <div class="tmpray-helper-dashboard-info-box cf">
        <h3 class="tmpray-helper-dashboard_title"><?php echo esc_html('Pray Time (Demo)', 'tm-islamic-helper');?></h3>
        <p>
            <a target="_blank" href="<?php echo tmpray_dashboard()->strings['theme_link']; ?>" class="button button-secondary tmpray-helper-admin-btn"><?php echo tmpray_dashboard()->strings['theme_text']; ?></a>
            <a target="_blank" href="<?php echo tmpray_dashboard()->strings['subscribe_link']; ?>" class="button button-secondary tmpray-helper-admin-btn"><?php echo tmpray_dashboard()->strings['subscribe_text']; ?></a>
            <a target="_blank" href="<?php echo tmpray_dashboard()->strings['support_link']; ?>" class="button button-primary tmpray-helper-admin-btn"><?php echo tmpray_dashboard()->strings['support_text']; ?></a>
            <a target="_blank" href="<?php echo tmpray_dashboard()->strings['documentation_link']; ?>" class="button button-primary tmpray-helper-admin-btn"><?php echo tmpray_dashboard()->strings['documentation_text']; ?></a>
        </p>
    </div>
    <div class="clear"></div>
    <div class="tmpray-helper-dashboard-nav cf">
        <a href="<?php echo admin_url('admin.php?page=tmpray_theme-dashboard'); ?>" class="nav-tab nav-tab-active"><?php echo __('Pray Time','tmpray-islamic-helper'); ?> </a>
        <a href="<?php echo admin_url('admin.php?page=tmpray_shortcodes'); ?>" class="nav-tab"><?php echo __('Shortcodes','tmpray-islamic-helper'); ?> </a>
    </div>

    <ul class="tmpray-ui-choose" id="demo">
        <li id="fill" class="selected"><?php echo esc_html__('Fill/Add','tmpray-islamic-helper');?></li>
        <li id="method"><?php echo esc_html__('Select Method','tmpray-islamic-helper');?></li>
    </ul>

    <div class="tmpray--fill-namaz">

        <?php echo esc_html__('The fill function is closed in the demo version.','tmpray-islamic-helper');?>
        <a href="https://codecanyon.net/item/praytimes-islamic-prayer-time-wordpress-plugin/24130516">
            <?php echo esc_html__('Get the full version of Plugin.','tmpray-islamic-helper');?>
        </a>
    </div>

    <div class="tmpray--select-method">

        <form method="post">
            <?php $namaz_time = get_page_by_title( 'settings', OBJECT, 'namaz-time' );
            $namaz_time_json = $namaz_time->post_content;
            $namaz_time_array = json_decode($namaz_time_json);
            ?>
            <div class="tmpray-select-method-container">
                <span><?php echo esc_html__('Method','tmpray-islamic-helper');?></span>
                <select id="tmpray--method" name="tmpray--method">
                    <option value="MWL" <?php if ($namaz_time_array->method == 'MWL') echo 'selected' ?>><?php echo esc_html__('Muslim World League','tmpray-islamic-helper');?></option>
                    <option value="ISNA" <?php if ($namaz_time_array->method == 'ISNA') echo 'selected' ?>><?php echo esc_html__('Islamic Society of North America','tmpray-islamic-helper');?></option>
                    <option value="Egypt" <?php if ($namaz_time_array->method == 'Egypt') echo 'selected' ?>><?php echo esc_html__('Egyptian General Authority of Survey','tmpray-islamic-helper');?></option>
                    <option value="Makkah" <?php if ($namaz_time_array->method == 'Makkah') echo 'selected' ?>><?php echo esc_html__('Umm al-Qura University, Makkah','tmpray-islamic-helper');?></option>
                    <option value="Karachi" <?php if ($namaz_time_array->method == 'Karachi') echo 'selected' ?>><?php echo esc_html__('University of Islamic Sciences, Karachi','tmpray-islamic-helper');?></option>
                    <option value="Tehran" <?php if ($namaz_time_array->method == 'Tehran') echo 'selected' ?>><?php echo esc_html__('Institute of Geophysics, University of Tehran','tmpray-islamic-helper');?></option>
                    <option value="Jafari" <?php if ($namaz_time_array->method == 'Jafari') echo 'selected' ?>><?php echo esc_html__('Shia Ithna Ashari, Leva Research Institute, Qum','tmpray-islamic-helper');?></option>
                </select>
            </div>

            <div class="tmpray-select-other-container">
                <div>
                    <span><?php echo esc_html__('Asr','tmpray-islamic-helper');?></span>
                    <select id="tmpray--asr" name="tmpray--asr">
                        <option value="Standard" <?php if ($namaz_time_array->asr == 'Standard') echo 'selected' ?>><?php echo esc_html__('Shafii, Maliki, Jafari and Hanbali (shadow factor = 1)','tmpray-islamic-helper');?></option>
                        <option value="Hanafi" <?php if ($namaz_time_array->asr == 'Hanafi') echo 'selected' ?>><?php echo esc_html__('Hanafi school of tought (shadow factor = 2)','tmpray-islamic-helper');?></option>
                    </select>
                </div>
                <div>
                    <span><?php echo esc_html__('Midnight','tmpray-islamic-helper');?></span>
                    <select id="tmpray--midnight" name="tmpray--midnight">
                        <option value="Standard" <?php if ($namaz_time_array->midnight == 'Standard') echo 'selected' ?>><?php echo esc_html__('The mean time from Sunset to Sunrise','tmpray-islamic-helper');?></option>
                        <option value="Jafari" <?php if ($namaz_time_array->midnight == 'Jafari') echo 'selected' ?>><?php echo esc_html__('The mean time from Maghrib to Fajr','tmpray-islamic-helper');?></option>
                    </select>
                </div>
                <div>
                    <span><?php echo esc_html__('Higher Latitudes','tmpray-islamic-helper');?></span>
                    <select id="tmpray--higher-latitudes" name="tmpray--higher-latitudes">
                        <option value="None" <?php if ($namaz_time_array->highLats == 'None') echo 'selected' ?>><?php echo esc_html__('No adjustments','tmpray-islamic-helper');?></option>
                        <option value="NightMiddle" <?php if ($namaz_time_array->highLats == 'NightMiddle') echo 'selected' ?>><?php echo esc_html__('The middle of the night method','tmpray-islamic-helper');?></option>
                        <option value="OneSeventh" <?php if ($namaz_time_array->highLats == 'OneSeventh') echo 'selected' ?>><?php echo esc_html__('The 1/7th of the night method','tmpray-islamic-helper');?></option>
                        <option value="NightMiddle" <?php if ($namaz_time_array->highLats == 'NightMiddle') echo 'selected' ?>><?php echo esc_html__('The angle-based method (recommended)','tmpray-islamic-helper');?></option>
                    </select>
                </div>
            </div>

            <div class="tmpray--tuning-times-contain">
                <span><?php echo esc_html__('Tuning Times','tmpray-islamic-helper');?></span>
                <div class="tmpray--tuning-contain">
                    <div class="tmpray--tuning-times-fajr">
                        <span><?php echo esc_html__('Fajr','tmpray-islamic-helper');?></span>
                        <select id="tmpray--tuning-times-fajr" name="tmpray--tuning-times">
                            <option value="-30" <?php if ($namaz_time_array->fajrtune == '-30') echo 'selected' ?>><?php echo esc_html__('-30 min','tmpray-islamic-helper');?></option>
                            <option value="-29" <?php if ($namaz_time_array->fajrtune == '-29') echo 'selected' ?>><?php echo esc_html__('-29 min','tmpray-islamic-helper');?></option>
                            <option value="-28" <?php if ($namaz_time_array->fajrtune == '-28') echo 'selected' ?>><?php echo esc_html__('-28 min','tmpray-islamic-helper');?></option>
                            <option value="-27" <?php if ($namaz_time_array->fajrtune == '-27') echo 'selected' ?>><?php echo esc_html__('-27 min','tmpray-islamic-helper');?></option>
                            <option value="-26" <?php if ($namaz_time_array->fajrtune == '-26') echo 'selected' ?>><?php echo esc_html__('-26 min','tmpray-islamic-helper');?></option>
                            <option value="-25" <?php if ($namaz_time_array->fajrtune == '-25') echo 'selected' ?>><?php echo esc_html__('-25 min','tmpray-islamic-helper');?></option>
                            <option value="-24" <?php if ($namaz_time_array->fajrtune == '-24') echo 'selected' ?>><?php echo esc_html__('-24 min','tmpray-islamic-helper');?></option>
                            <option value="-23" <?php if ($namaz_time_array->fajrtune == '-23') echo 'selected' ?>><?php echo esc_html__('-23 min','tmpray-islamic-helper');?></option>
                            <option value="-22" <?php if ($namaz_time_array->fajrtune == '-22') echo 'selected' ?>><?php echo esc_html__('-22 min','tmpray-islamic-helper');?></option>
                            <option value="-21" <?php if ($namaz_time_array->fajrtune == '-21') echo 'selected' ?>><?php echo esc_html__('-21 min','tmpray-islamic-helper');?></option>
                            <option value="-20" <?php if ($namaz_time_array->fajrtune == '-20') echo 'selected' ?>><?php echo esc_html__('-20 min','tmpray-islamic-helper');?></option>
                            <option value="-19" <?php if ($namaz_time_array->fajrtune == '-19') echo 'selected' ?>><?php echo esc_html__('-19 min','tmpray-islamic-helper');?></option>
                            <option value="-18" <?php if ($namaz_time_array->fajrtune == '-18') echo 'selected' ?>><?php echo esc_html__('-18 min','tmpray-islamic-helper');?></option>
                            <option value="-17" <?php if ($namaz_time_array->fajrtune == '-17') echo 'selected' ?>><?php echo esc_html__('-17 min','tmpray-islamic-helper');?></option>
                            <option value="-16" <?php if ($namaz_time_array->fajrtune == '-16') echo 'selected' ?>><?php echo esc_html__('-16 min','tmpray-islamic-helper');?></option>
                            <option value="-15" <?php if ($namaz_time_array->fajrtune == '-15') echo 'selected' ?>><?php echo esc_html__('-15 min','tmpray-islamic-helper');?></option>
                            <option value="-14" <?php if ($namaz_time_array->fajrtune == '-14') echo 'selected' ?>><?php echo esc_html__('-14 min','tmpray-islamic-helper');?></option>
                            <option value="-13" <?php if ($namaz_time_array->fajrtune == '-13') echo 'selected' ?>><?php echo esc_html__('-13 min','tmpray-islamic-helper');?></option>
                            <option value="-12" <?php if ($namaz_time_array->fajrtune == '-12') echo 'selected' ?>><?php echo esc_html__('-12 min','tmpray-islamic-helper');?></option>
                            <option value="-11" <?php if ($namaz_time_array->fajrtune == '-11') echo 'selected' ?>><?php echo esc_html__('-11 min','tmpray-islamic-helper');?></option>
                            <option value="-10" <?php if ($namaz_time_array->fajrtune == '-10') echo 'selected' ?>><?php echo esc_html__('-10 min','tmpray-islamic-helper');?></option>
                            <option value="-9" <?php if ($namaz_time_array->fajrtune == '-9') echo 'selected' ?>><?php echo esc_html__('-9 min','tmpray-islamic-helper');?></option>
                            <option value="-8" <?php if ($namaz_time_array->fajrtune == '-8') echo 'selected' ?>><?php echo esc_html__('-8 min','tmpray-islamic-helper');?></option>
                            <option value="-7" <?php if ($namaz_time_array->fajrtune == '-7') echo 'selected' ?>><?php echo esc_html__('-7 min','tmpray-islamic-helper');?></option>
                            <option value="-6" <?php if ($namaz_time_array->fajrtune == '-6') echo 'selected' ?>><?php echo esc_html__('-6 min','tmpray-islamic-helper');?></option>
                            <option value="-5" <?php if ($namaz_time_array->fajrtune == '-5') echo 'selected' ?>><?php echo esc_html__('-5 min','tmpray-islamic-helper');?></option>
                            <option value="-4" <?php if ($namaz_time_array->fajrtune == '-4') echo 'selected' ?>><?php echo esc_html__('-4 min','tmpray-islamic-helper');?></option>
                            <option value="-3" <?php if ($namaz_time_array->fajrtune == '-3') echo 'selected' ?>><?php echo esc_html__('-3 min','tmpray-islamic-helper');?></option>
                            <option value="-2" <?php if ($namaz_time_array->fajrtune == '-2') echo 'selected' ?>><?php echo esc_html__('-2 min','tmpray-islamic-helper');?></option>
                            <option value="-1" <?php if ($namaz_time_array->fajrtune == '-1') echo 'selected' ?>><?php echo esc_html__('-1 min','tmpray-islamic-helper');?></option>
                            <option value="0" <?php if ($namaz_time_array->fajrtune == '0') echo 'selected' ?>><?php echo esc_html__('0 min','tmpray-islamic-helper');?></option>
                            <option value="1" <?php if ($namaz_time_array->fajrtune == '1') echo 'selected' ?>><?php echo esc_html__('1 min','tmpray-islamic-helper');?></option>
                            <option value="2" <?php if ($namaz_time_array->fajrtune == '2') echo 'selected' ?>><?php echo esc_html__('2 min','tmpray-islamic-helper');?></option>
                            <option value="3" <?php if ($namaz_time_array->fajrtune == '3') echo 'selected' ?>><?php echo esc_html__('3 min','tmpray-islamic-helper');?></option>
                            <option value="4" <?php if ($namaz_time_array->fajrtune == '4') echo 'selected' ?>><?php echo esc_html__('4 min','tmpray-islamic-helper');?></option>
                            <option value="5" <?php if ($namaz_time_array->fajrtune == '5') echo 'selected' ?>><?php echo esc_html__('5 min','tmpray-islamic-helper');?></option>
                            <option value="6" <?php if ($namaz_time_array->fajrtune == '6') echo 'selected' ?>><?php echo esc_html__('6 min','tmpray-islamic-helper');?></option>
                            <option value="7" <?php if ($namaz_time_array->fajrtune == '7') echo 'selected' ?>><?php echo esc_html__('7 min','tmpray-islamic-helper');?></option>
                            <option value="8" <?php if ($namaz_time_array->fajrtune == '8') echo 'selected' ?>><?php echo esc_html__('8 min','tmpray-islamic-helper');?></option>
                            <option value="9" <?php if ($namaz_time_array->fajrtune == '9') echo 'selected' ?>><?php echo esc_html__('9 min','tmpray-islamic-helper');?></option>
                            <option value="10" <?php if ($namaz_time_array->fajrtune == '10') echo 'selected' ?>><?php echo esc_html__('10 min','tmpray-islamic-helper');?></option>
                            <option value="11" <?php if ($namaz_time_array->fajrtune == '11') echo 'selected' ?>><?php echo esc_html__('11 min','tmpray-islamic-helper');?></option>
                            <option value="12" <?php if ($namaz_time_array->fajrtune == '12') echo 'selected' ?>><?php echo esc_html__('12 min','tmpray-islamic-helper');?></option>
                            <option value="13" <?php if ($namaz_time_array->fajrtune == '13') echo 'selected' ?>><?php echo esc_html__('13 min','tmpray-islamic-helper');?></option>
                            <option value="14" <?php if ($namaz_time_array->fajrtune == '14') echo 'selected' ?>><?php echo esc_html__('14 min','tmpray-islamic-helper');?></option>
                            <option value="15" <?php if ($namaz_time_array->fajrtune == '15') echo 'selected' ?>><?php echo esc_html__('15 min','tmpray-islamic-helper');?></option>
                            <option value="16" <?php if ($namaz_time_array->fajrtune == '16') echo 'selected' ?>><?php echo esc_html__('16 min','tmpray-islamic-helper');?></option>
                            <option value="17" <?php if ($namaz_time_array->fajrtune == '17') echo 'selected' ?>><?php echo esc_html__('17 min','tmpray-islamic-helper');?></option>
                            <option value="18" <?php if ($namaz_time_array->fajrtune == '18') echo 'selected' ?>><?php echo esc_html__('18 min','tmpray-islamic-helper');?></option>
                            <option value="19" <?php if ($namaz_time_array->fajrtune == '19') echo 'selected' ?>><?php echo esc_html__('19 min','tmpray-islamic-helper');?></option>
                            <option value="20" <?php if ($namaz_time_array->fajrtune == '20') echo 'selected' ?>><?php echo esc_html__('20 min','tmpray-islamic-helper');?></option>
                            <option value="21" <?php if ($namaz_time_array->fajrtune == '21') echo 'selected' ?>><?php echo esc_html__('21 min','tmpray-islamic-helper');?></option>
                            <option value="22" <?php if ($namaz_time_array->fajrtune == '22') echo 'selected' ?>><?php echo esc_html__('22 min','tmpray-islamic-helper');?></option>
                            <option value="23" <?php if ($namaz_time_array->fajrtune == '23') echo 'selected' ?>><?php echo esc_html__('23 min','tmpray-islamic-helper');?></option>
                            <option value="24" <?php if ($namaz_time_array->fajrtune == '24') echo 'selected' ?>><?php echo esc_html__('24 min','tmpray-islamic-helper');?></option>
                            <option value="25" <?php if ($namaz_time_array->fajrtune == '25') echo 'selected' ?>><?php echo esc_html__('25 min','tmpray-islamic-helper');?></option>
                            <option value="26" <?php if ($namaz_time_array->fajrtune == '26') echo 'selected' ?>><?php echo esc_html__('26 min','tmpray-islamic-helper');?></option>
                            <option value="27" <?php if ($namaz_time_array->fajrtune == '27') echo 'selected' ?>><?php echo esc_html__('27 min','tmpray-islamic-helper');?></option>
                            <option value="28" <?php if ($namaz_time_array->fajrtune == '28') echo 'selected' ?>><?php echo esc_html__('28 min','tmpray-islamic-helper');?></option>
                            <option value="29" <?php if ($namaz_time_array->fajrtune == '29') echo 'selected' ?>><?php echo esc_html__('29 min','tmpray-islamic-helper');?></option>
                            <option value="30" <?php if ($namaz_time_array->fajrtune == '30') echo 'selected' ?>><?php echo esc_html__('30 min','tmpray-islamic-helper');?></option>
                        </select>
                    </div>
                    <div class="tmpray--tuning-times-sunrise">
                        <span><?php echo esc_html__('Sunrise','tmpray-islamic-helper');?></span>
                        <select id="tmpray--tuning-times-sunrise" name="tmpray--tuning-times">
                            <option value="-30" <?php if ($namaz_time_array->sunrisetune == '-30') echo 'selected' ?>><?php echo esc_html__('-30 min','tmpray-islamic-helper');?></option>
                            <option value="-29" <?php if ($namaz_time_array->sunrisetune == '-29') echo 'selected' ?>><?php echo esc_html__('-29 min','tmpray-islamic-helper');?></option>
                            <option value="-28" <?php if ($namaz_time_array->sunrisetune == '-28') echo 'selected' ?>><?php echo esc_html__('-28 min','tmpray-islamic-helper');?></option>
                            <option value="-27" <?php if ($namaz_time_array->sunrisetune == '-27') echo 'selected' ?>><?php echo esc_html__('-27 min','tmpray-islamic-helper');?></option>
                            <option value="-26" <?php if ($namaz_time_array->sunrisetune == '-26') echo 'selected' ?>><?php echo esc_html__('-26 min','tmpray-islamic-helper');?></option>
                            <option value="-25" <?php if ($namaz_time_array->sunrisetune == '-25') echo 'selected' ?>><?php echo esc_html__('-25 min','tmpray-islamic-helper');?></option>
                            <option value="-24" <?php if ($namaz_time_array->sunrisetune == '-24') echo 'selected' ?>><?php echo esc_html__('-24 min','tmpray-islamic-helper');?></option>
                            <option value="-23" <?php if ($namaz_time_array->sunrisetune == '-23') echo 'selected' ?>><?php echo esc_html__('-23 min','tmpray-islamic-helper');?></option>
                            <option value="-22" <?php if ($namaz_time_array->sunrisetune == '-22') echo 'selected' ?>><?php echo esc_html__('-22 min','tmpray-islamic-helper');?></option>
                            <option value="-21" <?php if ($namaz_time_array->sunrisetune == '-21') echo 'selected' ?>><?php echo esc_html__('-21 min','tmpray-islamic-helper');?></option>
                            <option value="-20" <?php if ($namaz_time_array->sunrisetune == '-20') echo 'selected' ?>><?php echo esc_html__('-20 min','tmpray-islamic-helper');?></option>
                            <option value="-19" <?php if ($namaz_time_array->sunrisetune == '-19') echo 'selected' ?>><?php echo esc_html__('-19 min','tmpray-islamic-helper');?></option>
                            <option value="-18" <?php if ($namaz_time_array->sunrisetune == '-18') echo 'selected' ?>><?php echo esc_html__('-18 min','tmpray-islamic-helper');?></option>
                            <option value="-17" <?php if ($namaz_time_array->sunrisetune == '-17') echo 'selected' ?>><?php echo esc_html__('-17 min','tmpray-islamic-helper');?></option>
                            <option value="-16" <?php if ($namaz_time_array->sunrisetune == '-16') echo 'selected' ?>><?php echo esc_html__('-16 min','tmpray-islamic-helper');?></option>
                            <option value="-15" <?php if ($namaz_time_array->sunrisetune == '-15') echo 'selected' ?>><?php echo esc_html__('-15 min','tmpray-islamic-helper');?></option>
                            <option value="-14" <?php if ($namaz_time_array->sunrisetune == '-14') echo 'selected' ?>><?php echo esc_html__('-14 min','tmpray-islamic-helper');?></option>
                            <option value="-13" <?php if ($namaz_time_array->sunrisetune == '-13') echo 'selected' ?>><?php echo esc_html__('-13 min','tmpray-islamic-helper');?></option>
                            <option value="-12" <?php if ($namaz_time_array->sunrisetune == '-12') echo 'selected' ?>><?php echo esc_html__('-12 min','tmpray-islamic-helper');?></option>
                            <option value="-11" <?php if ($namaz_time_array->sunrisetune == '-11') echo 'selected' ?>><?php echo esc_html__('-11 min','tmpray-islamic-helper');?></option>
                            <option value="-10" <?php if ($namaz_time_array->sunrisetune == '-10') echo 'selected' ?>><?php echo esc_html__('-10 min','tmpray-islamic-helper');?></option>
                            <option value="-9" <?php if ($namaz_time_array->sunrisetune == '-9') echo 'selected' ?>><?php echo esc_html__('-9 min','tmpray-islamic-helper');?></option>
                            <option value="-8" <?php if ($namaz_time_array->sunrisetune == '-8') echo 'selected' ?>><?php echo esc_html__('-8 min','tmpray-islamic-helper');?></option>
                            <option value="-7" <?php if ($namaz_time_array->sunrisetune == '-7') echo 'selected' ?>><?php echo esc_html__('-7 min','tmpray-islamic-helper');?></option>
                            <option value="-6" <?php if ($namaz_time_array->sunrisetune == '-6') echo 'selected' ?>><?php echo esc_html__('-6 min','tmpray-islamic-helper');?></option>
                            <option value="-5" <?php if ($namaz_time_array->sunrisetune == '-5') echo 'selected' ?>><?php echo esc_html__('-5 min','tmpray-islamic-helper');?></option>
                            <option value="-4" <?php if ($namaz_time_array->sunrisetune == '-4') echo 'selected' ?>><?php echo esc_html__('-4 min','tmpray-islamic-helper');?></option>
                            <option value="-3" <?php if ($namaz_time_array->sunrisetune == '-3') echo 'selected' ?>><?php echo esc_html__('-3 min','tmpray-islamic-helper');?></option>
                            <option value="-2" <?php if ($namaz_time_array->sunrisetune == '-2') echo 'selected' ?>><?php echo esc_html__('-2 min','tmpray-islamic-helper');?></option>
                            <option value="-1" <?php if ($namaz_time_array->sunrisetune == '-1') echo 'selected' ?>><?php echo esc_html__('-1 min','tmpray-islamic-helper');?></option>
                            <option value="0" <?php if ($namaz_time_array->sunrisetune == '0') echo 'selected' ?>><?php echo esc_html__('0 min','tmpray-islamic-helper');?></option>
                            <option value="1" <?php if ($namaz_time_array->sunrisetune == '1') echo 'selected' ?>><?php echo esc_html__('1 min','tmpray-islamic-helper');?></option>
                            <option value="2" <?php if ($namaz_time_array->sunrisetune == '2') echo 'selected' ?>><?php echo esc_html__('2 min','tmpray-islamic-helper');?></option>
                            <option value="3" <?php if ($namaz_time_array->sunrisetune == '3') echo 'selected' ?>><?php echo esc_html__('3 min','tmpray-islamic-helper');?></option>
                            <option value="4" <?php if ($namaz_time_array->sunrisetune == '4') echo 'selected' ?>><?php echo esc_html__('4 min','tmpray-islamic-helper');?></option>
                            <option value="5" <?php if ($namaz_time_array->sunrisetune == '5') echo 'selected' ?>><?php echo esc_html__('5 min','tmpray-islamic-helper');?></option>
                            <option value="6" <?php if ($namaz_time_array->sunrisetune == '6') echo 'selected' ?>><?php echo esc_html__('6 min','tmpray-islamic-helper');?></option>
                            <option value="7" <?php if ($namaz_time_array->sunrisetune == '7') echo 'selected' ?>><?php echo esc_html__('7 min','tmpray-islamic-helper');?></option>
                            <option value="8" <?php if ($namaz_time_array->sunrisetune == '8') echo 'selected' ?>><?php echo esc_html__('8 min','tmpray-islamic-helper');?></option>
                            <option value="9" <?php if ($namaz_time_array->sunrisetune == '9') echo 'selected' ?>><?php echo esc_html__('9 min','tmpray-islamic-helper');?></option>
                            <option value="10" <?php if ($namaz_time_array->sunrisetune == '10') echo 'selected' ?>><?php echo esc_html__('10 min','tmpray-islamic-helper');?></option>
                            <option value="11" <?php if ($namaz_time_array->sunrisetune == '11') echo 'selected' ?>><?php echo esc_html__('11 min','tmpray-islamic-helper');?></option>
                            <option value="12" <?php if ($namaz_time_array->sunrisetune == '12') echo 'selected' ?>><?php echo esc_html__('12 min','tmpray-islamic-helper');?></option>
                            <option value="13" <?php if ($namaz_time_array->sunrisetune == '13') echo 'selected' ?>><?php echo esc_html__('13 min','tmpray-islamic-helper');?></option>
                            <option value="14" <?php if ($namaz_time_array->sunrisetune == '14') echo 'selected' ?>><?php echo esc_html__('14 min','tmpray-islamic-helper');?></option>
                            <option value="15" <?php if ($namaz_time_array->sunrisetune == '15') echo 'selected' ?>><?php echo esc_html__('15 min','tmpray-islamic-helper');?></option>
                            <option value="16" <?php if ($namaz_time_array->sunrisetune == '16') echo 'selected' ?>><?php echo esc_html__('16 min','tmpray-islamic-helper');?></option>
                            <option value="17" <?php if ($namaz_time_array->sunrisetune == '17') echo 'selected' ?>><?php echo esc_html__('17 min','tmpray-islamic-helper');?></option>
                            <option value="18" <?php if ($namaz_time_array->sunrisetune == '18') echo 'selected' ?>><?php echo esc_html__('18 min','tmpray-islamic-helper');?></option>
                            <option value="19" <?php if ($namaz_time_array->sunrisetune == '19') echo 'selected' ?>><?php echo esc_html__('19 min','tmpray-islamic-helper');?></option>
                            <option value="20" <?php if ($namaz_time_array->sunrisetune == '20') echo 'selected' ?>><?php echo esc_html__('20 min','tmpray-islamic-helper');?></option>
                            <option value="21" <?php if ($namaz_time_array->sunrisetune == '21') echo 'selected' ?>><?php echo esc_html__('21 min','tmpray-islamic-helper');?></option>
                            <option value="22" <?php if ($namaz_time_array->sunrisetune == '22') echo 'selected' ?>><?php echo esc_html__('22 min','tmpray-islamic-helper');?></option>
                            <option value="23" <?php if ($namaz_time_array->sunrisetune == '23') echo 'selected' ?>><?php echo esc_html__('23 min','tmpray-islamic-helper');?></option>
                            <option value="24" <?php if ($namaz_time_array->sunrisetune == '24') echo 'selected' ?>><?php echo esc_html__('24 min','tmpray-islamic-helper');?></option>
                            <option value="25" <?php if ($namaz_time_array->sunrisetune == '25') echo 'selected' ?>><?php echo esc_html__('25 min','tmpray-islamic-helper');?></option>
                            <option value="26" <?php if ($namaz_time_array->sunrisetune == '26') echo 'selected' ?>><?php echo esc_html__('26 min','tmpray-islamic-helper');?></option>
                            <option value="27" <?php if ($namaz_time_array->sunrisetune == '27') echo 'selected' ?>><?php echo esc_html__('27 min','tmpray-islamic-helper');?></option>
                            <option value="28" <?php if ($namaz_time_array->sunrisetune == '28') echo 'selected' ?>><?php echo esc_html__('28 min','tmpray-islamic-helper');?></option>
                            <option value="29" <?php if ($namaz_time_array->sunrisetune == '29') echo 'selected' ?>><?php echo esc_html__('29 min','tmpray-islamic-helper');?></option>
                            <option value="30" <?php if ($namaz_time_array->sunrisetune == '30') echo 'selected' ?>><?php echo esc_html__('30 min','tmpray-islamic-helper');?></option>
                        </select>
                    </div>
                    <div class="tmpray--tuning-times-dhuhr">
                        <span><?php echo esc_html__('Dhuhr','tmpray-islamic-helper');?></span>
                        <select id="tmpray--tuning-times-dhuhr" name="tmpray--tuning-times">
                            <option value="-30" <?php if ($namaz_time_array->dhuhrtune == '-30') echo 'selected' ?>><?php echo esc_html__('-30 min','tmpray-islamic-helper');?></option>
                            <option value="-29" <?php if ($namaz_time_array->dhuhrtune == '-29') echo 'selected' ?>><?php echo esc_html__('-29 min','tmpray-islamic-helper');?></option>
                            <option value="-28" <?php if ($namaz_time_array->dhuhrtune == '-28') echo 'selected' ?>><?php echo esc_html__('-28 min','tmpray-islamic-helper');?></option>
                            <option value="-27" <?php if ($namaz_time_array->dhuhrtune == '-27') echo 'selected' ?>><?php echo esc_html__('-27 min','tmpray-islamic-helper');?></option>
                            <option value="-26" <?php if ($namaz_time_array->dhuhrtune == '-26') echo 'selected' ?>><?php echo esc_html__('-26 min','tmpray-islamic-helper');?></option>
                            <option value="-25" <?php if ($namaz_time_array->dhuhrtune == '-25') echo 'selected' ?>><?php echo esc_html__('-25 min','tmpray-islamic-helper');?></option>
                            <option value="-24" <?php if ($namaz_time_array->dhuhrtune == '-24') echo 'selected' ?>><?php echo esc_html__('-24 min','tmpray-islamic-helper');?></option>
                            <option value="-23" <?php if ($namaz_time_array->dhuhrtune == '-23') echo 'selected' ?>><?php echo esc_html__('-23 min','tmpray-islamic-helper');?></option>
                            <option value="-22" <?php if ($namaz_time_array->dhuhrtune == '-22') echo 'selected' ?>><?php echo esc_html__('-22 min','tmpray-islamic-helper');?></option>
                            <option value="-21" <?php if ($namaz_time_array->dhuhrtune == '-21') echo 'selected' ?>><?php echo esc_html__('-21 min','tmpray-islamic-helper');?></option>
                            <option value="-20" <?php if ($namaz_time_array->dhuhrtune == '-20') echo 'selected' ?>><?php echo esc_html__('-20 min','tmpray-islamic-helper');?></option>
                            <option value="-19" <?php if ($namaz_time_array->dhuhrtune == '-19') echo 'selected' ?>><?php echo esc_html__('-19 min','tmpray-islamic-helper');?></option>
                            <option value="-18" <?php if ($namaz_time_array->dhuhrtune == '-18') echo 'selected' ?>><?php echo esc_html__('-18 min','tmpray-islamic-helper');?></option>
                            <option value="-17" <?php if ($namaz_time_array->dhuhrtune == '-17') echo 'selected' ?>><?php echo esc_html__('-17 min','tmpray-islamic-helper');?></option>
                            <option value="-16" <?php if ($namaz_time_array->dhuhrtune == '-16') echo 'selected' ?>><?php echo esc_html__('-16 min','tmpray-islamic-helper');?></option>
                            <option value="-15" <?php if ($namaz_time_array->dhuhrtune == '-15') echo 'selected' ?>><?php echo esc_html__('-15 min','tmpray-islamic-helper');?></option>
                            <option value="-14" <?php if ($namaz_time_array->dhuhrtune == '-14') echo 'selected' ?>><?php echo esc_html__('-14 min','tmpray-islamic-helper');?></option>
                            <option value="-13" <?php if ($namaz_time_array->dhuhrtune == '-13') echo 'selected' ?>><?php echo esc_html__('-13 min','tmpray-islamic-helper');?></option>
                            <option value="-12" <?php if ($namaz_time_array->dhuhrtune == '-12') echo 'selected' ?>><?php echo esc_html__('-12 min','tmpray-islamic-helper');?></option>
                            <option value="-11" <?php if ($namaz_time_array->dhuhrtune == '-11') echo 'selected' ?>><?php echo esc_html__('-11 min','tmpray-islamic-helper');?></option>
                            <option value="-10" <?php if ($namaz_time_array->dhuhrtune == '-10') echo 'selected' ?>><?php echo esc_html__('-10 min','tmpray-islamic-helper');?></option>
                            <option value="-9" <?php if ($namaz_time_array->dhuhrtune == '-9') echo 'selected' ?>><?php echo esc_html__('-9 min','tmpray-islamic-helper');?></option>
                            <option value="-8" <?php if ($namaz_time_array->dhuhrtune == '-8') echo 'selected' ?>><?php echo esc_html__('-8 min','tmpray-islamic-helper');?></option>
                            <option value="-7" <?php if ($namaz_time_array->dhuhrtune == '-7') echo 'selected' ?>><?php echo esc_html__('-7 min','tmpray-islamic-helper');?></option>
                            <option value="-6" <?php if ($namaz_time_array->dhuhrtune == '-6') echo 'selected' ?>><?php echo esc_html__('-6 min','tmpray-islamic-helper');?></option>
                            <option value="-5" <?php if ($namaz_time_array->dhuhrtune == '-5') echo 'selected' ?>><?php echo esc_html__('-5 min','tmpray-islamic-helper');?></option>
                            <option value="-4" <?php if ($namaz_time_array->dhuhrtune == '-4') echo 'selected' ?>><?php echo esc_html__('-4 min','tmpray-islamic-helper');?></option>
                            <option value="-3" <?php if ($namaz_time_array->dhuhrtune == '-3') echo 'selected' ?>><?php echo esc_html__('-3 min','tmpray-islamic-helper');?></option>
                            <option value="-2" <?php if ($namaz_time_array->dhuhrtune == '-2') echo 'selected' ?>><?php echo esc_html__('-2 min','tmpray-islamic-helper');?></option>
                            <option value="-1" <?php if ($namaz_time_array->dhuhrtune == '-1') echo 'selected' ?>><?php echo esc_html__('-1 min','tmpray-islamic-helper');?></option>
                            <option value="0" <?php if ($namaz_time_array->dhuhrtune == '0') echo 'selected' ?>><?php echo esc_html__('0 min','tmpray-islamic-helper');?></option>
                            <option value="1" <?php if ($namaz_time_array->dhuhrtune == '1') echo 'selected' ?>><?php echo esc_html__('1 min','tmpray-islamic-helper');?></option>
                            <option value="2" <?php if ($namaz_time_array->dhuhrtune == '2') echo 'selected' ?>><?php echo esc_html__('2 min','tmpray-islamic-helper');?></option>
                            <option value="3" <?php if ($namaz_time_array->dhuhrtune == '3') echo 'selected' ?>><?php echo esc_html__('3 min','tmpray-islamic-helper');?></option>
                            <option value="4" <?php if ($namaz_time_array->dhuhrtune == '4') echo 'selected' ?>><?php echo esc_html__('4 min','tmpray-islamic-helper');?></option>
                            <option value="5" <?php if ($namaz_time_array->dhuhrtune == '5') echo 'selected' ?>><?php echo esc_html__('5 min','tmpray-islamic-helper');?></option>
                            <option value="6" <?php if ($namaz_time_array->dhuhrtune == '6') echo 'selected' ?>><?php echo esc_html__('6 min','tmpray-islamic-helper');?></option>
                            <option value="7" <?php if ($namaz_time_array->dhuhrtune == '7') echo 'selected' ?>><?php echo esc_html__('7 min','tmpray-islamic-helper');?></option>
                            <option value="8" <?php if ($namaz_time_array->dhuhrtune == '8') echo 'selected' ?>><?php echo esc_html__('8 min','tmpray-islamic-helper');?></option>
                            <option value="9" <?php if ($namaz_time_array->dhuhrtune == '9') echo 'selected' ?>><?php echo esc_html__('9 min','tmpray-islamic-helper');?></option>
                            <option value="10" <?php if ($namaz_time_array->dhuhrtune == '10') echo 'selected' ?>><?php echo esc_html__('10 min','tmpray-islamic-helper');?></option>
                            <option value="11" <?php if ($namaz_time_array->dhuhrtune == '11') echo 'selected' ?>><?php echo esc_html__('11 min','tmpray-islamic-helper');?></option>
                            <option value="12" <?php if ($namaz_time_array->dhuhrtune == '12') echo 'selected' ?>><?php echo esc_html__('12 min','tmpray-islamic-helper');?></option>
                            <option value="13" <?php if ($namaz_time_array->dhuhrtune == '13') echo 'selected' ?>><?php echo esc_html__('13 min','tmpray-islamic-helper');?></option>
                            <option value="14" <?php if ($namaz_time_array->dhuhrtune == '14') echo 'selected' ?>><?php echo esc_html__('14 min','tmpray-islamic-helper');?></option>
                            <option value="15" <?php if ($namaz_time_array->dhuhrtune == '15') echo 'selected' ?>><?php echo esc_html__('15 min','tmpray-islamic-helper');?></option>
                            <option value="16" <?php if ($namaz_time_array->dhuhrtune == '16') echo 'selected' ?>><?php echo esc_html__('16 min','tmpray-islamic-helper');?></option>
                            <option value="17" <?php if ($namaz_time_array->dhuhrtune == '17') echo 'selected' ?>><?php echo esc_html__('17 min','tmpray-islamic-helper');?></option>
                            <option value="18" <?php if ($namaz_time_array->dhuhrtune == '18') echo 'selected' ?>><?php echo esc_html__('18 min','tmpray-islamic-helper');?></option>
                            <option value="19" <?php if ($namaz_time_array->dhuhrtune == '19') echo 'selected' ?>><?php echo esc_html__('19 min','tmpray-islamic-helper');?></option>
                            <option value="20" <?php if ($namaz_time_array->dhuhrtune == '20') echo 'selected' ?>><?php echo esc_html__('20 min','tmpray-islamic-helper');?></option>
                            <option value="21" <?php if ($namaz_time_array->dhuhrtune == '21') echo 'selected' ?>><?php echo esc_html__('21 min','tmpray-islamic-helper');?></option>
                            <option value="22" <?php if ($namaz_time_array->dhuhrtune == '22') echo 'selected' ?>><?php echo esc_html__('22 min','tmpray-islamic-helper');?></option>
                            <option value="23" <?php if ($namaz_time_array->dhuhrtune == '23') echo 'selected' ?>><?php echo esc_html__('23 min','tmpray-islamic-helper');?></option>
                            <option value="24" <?php if ($namaz_time_array->dhuhrtune == '24') echo 'selected' ?>><?php echo esc_html__('24 min','tmpray-islamic-helper');?></option>
                            <option value="25" <?php if ($namaz_time_array->dhuhrtune == '25') echo 'selected' ?>><?php echo esc_html__('25 min','tmpray-islamic-helper');?></option>
                            <option value="26" <?php if ($namaz_time_array->dhuhrtune == '26') echo 'selected' ?>><?php echo esc_html__('26 min','tmpray-islamic-helper');?></option>
                            <option value="27" <?php if ($namaz_time_array->dhuhrtune == '27') echo 'selected' ?>><?php echo esc_html__('27 min','tmpray-islamic-helper');?></option>
                            <option value="28" <?php if ($namaz_time_array->dhuhrtune == '28') echo 'selected' ?>><?php echo esc_html__('28 min','tmpray-islamic-helper');?></option>
                            <option value="29" <?php if ($namaz_time_array->dhuhrtune == '29') echo 'selected' ?>><?php echo esc_html__('29 min','tmpray-islamic-helper');?></option>
                            <option value="30" <?php if ($namaz_time_array->dhuhrtune == '30') echo 'selected' ?>><?php echo esc_html__('30 min','tmpray-islamic-helper');?></option>
                        </select>
                    </div>
                    <div class="tmpray--tuning-times-asr">
                        <span><?php echo esc_html__('Asr','tmpray-islamic-helper');?></span>
                        <select id="tmpray--tuning-times-asr" name="tmpray--tuning-times">
                            <option value="-30" <?php if ($namaz_time_array->asrtune == '-30') echo 'selected' ?>><?php echo esc_html__('-30 min','tmpray-islamic-helper');?></option>
                            <option value="-29" <?php if ($namaz_time_array->asrtune == '-29') echo 'selected' ?>><?php echo esc_html__('-29 min','tmpray-islamic-helper');?></option>
                            <option value="-28" <?php if ($namaz_time_array->asrtune == '-28') echo 'selected' ?>><?php echo esc_html__('-28 min','tmpray-islamic-helper');?></option>
                            <option value="-27" <?php if ($namaz_time_array->asrtune == '-27') echo 'selected' ?>><?php echo esc_html__('-27 min','tmpray-islamic-helper');?></option>
                            <option value="-26" <?php if ($namaz_time_array->asrtune == '-26') echo 'selected' ?>><?php echo esc_html__('-26 min','tmpray-islamic-helper');?></option>
                            <option value="-25" <?php if ($namaz_time_array->asrtune == '-25') echo 'selected' ?>><?php echo esc_html__('-25 min','tmpray-islamic-helper');?></option>
                            <option value="-24" <?php if ($namaz_time_array->asrtune == '-24') echo 'selected' ?>><?php echo esc_html__('-24 min','tmpray-islamic-helper');?></option>
                            <option value="-23" <?php if ($namaz_time_array->asrtune == '-23') echo 'selected' ?>><?php echo esc_html__('-23 min','tmpray-islamic-helper');?></option>
                            <option value="-22" <?php if ($namaz_time_array->asrtune == '-22') echo 'selected' ?>><?php echo esc_html__('-22 min','tmpray-islamic-helper');?></option>
                            <option value="-21" <?php if ($namaz_time_array->asrtune == '-21') echo 'selected' ?>><?php echo esc_html__('-21 min','tmpray-islamic-helper');?></option>
                            <option value="-20" <?php if ($namaz_time_array->asrtune == '-20') echo 'selected' ?>><?php echo esc_html__('-20 min','tmpray-islamic-helper');?></option>
                            <option value="-19" <?php if ($namaz_time_array->asrtune == '-19') echo 'selected' ?>><?php echo esc_html__('-19 min','tmpray-islamic-helper');?></option>
                            <option value="-18" <?php if ($namaz_time_array->asrtune == '-18') echo 'selected' ?>><?php echo esc_html__('-18 min','tmpray-islamic-helper');?></option>
                            <option value="-17" <?php if ($namaz_time_array->asrtune == '-17') echo 'selected' ?>><?php echo esc_html__('-17 min','tmpray-islamic-helper');?></option>
                            <option value="-16" <?php if ($namaz_time_array->asrtune == '-16') echo 'selected' ?>><?php echo esc_html__('-16 min','tmpray-islamic-helper');?></option>
                            <option value="-15" <?php if ($namaz_time_array->asrtune == '-15') echo 'selected' ?>><?php echo esc_html__('-15 min','tmpray-islamic-helper');?></option>
                            <option value="-14" <?php if ($namaz_time_array->asrtune == '-14') echo 'selected' ?>><?php echo esc_html__('-14 min','tmpray-islamic-helper');?></option>
                            <option value="-13" <?php if ($namaz_time_array->asrtune == '-13') echo 'selected' ?>><?php echo esc_html__('-13 min','tmpray-islamic-helper');?></option>
                            <option value="-12" <?php if ($namaz_time_array->asrtune == '-12') echo 'selected' ?>><?php echo esc_html__('-12 min','tmpray-islamic-helper');?></option>
                            <option value="-11" <?php if ($namaz_time_array->asrtune == '-11') echo 'selected' ?>><?php echo esc_html__('-11 min','tmpray-islamic-helper');?></option>
                            <option value="-10" <?php if ($namaz_time_array->asrtune == '-10') echo 'selected' ?>><?php echo esc_html__('-10 min','tmpray-islamic-helper');?></option>
                            <option value="-9" <?php if ($namaz_time_array->asrtune == '-9') echo 'selected' ?>><?php echo esc_html__('-9 min','tmpray-islamic-helper');?></option>
                            <option value="-8" <?php if ($namaz_time_array->asrtune == '-8') echo 'selected' ?>><?php echo esc_html__('-8 min','tmpray-islamic-helper');?></option>
                            <option value="-7" <?php if ($namaz_time_array->asrtune == '-7') echo 'selected' ?>><?php echo esc_html__('-7 min','tmpray-islamic-helper');?></option>
                            <option value="-6" <?php if ($namaz_time_array->asrtune == '-6') echo 'selected' ?>><?php echo esc_html__('-6 min','tmpray-islamic-helper');?></option>
                            <option value="-5" <?php if ($namaz_time_array->asrtune == '-5') echo 'selected' ?>><?php echo esc_html__('-5 min','tmpray-islamic-helper');?></option>
                            <option value="-4" <?php if ($namaz_time_array->asrtune == '-4') echo 'selected' ?>><?php echo esc_html__('-4 min','tmpray-islamic-helper');?></option>
                            <option value="-3" <?php if ($namaz_time_array->asrtune == '-3') echo 'selected' ?>><?php echo esc_html__('-3 min','tmpray-islamic-helper');?></option>
                            <option value="-2" <?php if ($namaz_time_array->asrtune == '-2') echo 'selected' ?>><?php echo esc_html__('-2 min','tmpray-islamic-helper');?></option>
                            <option value="-1" <?php if ($namaz_time_array->asrtune == '-1') echo 'selected' ?>><?php echo esc_html__('-1 min','tmpray-islamic-helper');?></option>
                            <option value="0" <?php if ($namaz_time_array->asrtune == '0') echo 'selected' ?>><?php echo esc_html__('0 min','tmpray-islamic-helper');?></option>
                            <option value="1" <?php if ($namaz_time_array->asrtune == '1') echo 'selected' ?>><?php echo esc_html__('1 min','tmpray-islamic-helper');?></option>
                            <option value="2" <?php if ($namaz_time_array->asrtune == '2') echo 'selected' ?>><?php echo esc_html__('2 min','tmpray-islamic-helper');?></option>
                            <option value="3" <?php if ($namaz_time_array->asrtune == '3') echo 'selected' ?>><?php echo esc_html__('3 min','tmpray-islamic-helper');?></option>
                            <option value="4" <?php if ($namaz_time_array->asrtune == '4') echo 'selected' ?>><?php echo esc_html__('4 min','tmpray-islamic-helper');?></option>
                            <option value="5" <?php if ($namaz_time_array->asrtune == '5') echo 'selected' ?>><?php echo esc_html__('5 min','tmpray-islamic-helper');?></option>
                            <option value="6" <?php if ($namaz_time_array->asrtune == '6') echo 'selected' ?>><?php echo esc_html__('6 min','tmpray-islamic-helper');?></option>
                            <option value="7" <?php if ($namaz_time_array->asrtune == '7') echo 'selected' ?>><?php echo esc_html__('7 min','tmpray-islamic-helper');?></option>
                            <option value="8" <?php if ($namaz_time_array->asrtune == '8') echo 'selected' ?>><?php echo esc_html__('8 min','tmpray-islamic-helper');?></option>
                            <option value="9" <?php if ($namaz_time_array->asrtune == '9') echo 'selected' ?>><?php echo esc_html__('9 min','tmpray-islamic-helper');?></option>
                            <option value="10" <?php if ($namaz_time_array->asrtune == '10') echo 'selected' ?>><?php echo esc_html__('10 min','tmpray-islamic-helper');?></option>
                            <option value="11" <?php if ($namaz_time_array->asrtune == '11') echo 'selected' ?>><?php echo esc_html__('11 min','tmpray-islamic-helper');?></option>
                            <option value="12" <?php if ($namaz_time_array->asrtune == '12') echo 'selected' ?>><?php echo esc_html__('12 min','tmpray-islamic-helper');?></option>
                            <option value="13" <?php if ($namaz_time_array->asrtune == '13') echo 'selected' ?>><?php echo esc_html__('13 min','tmpray-islamic-helper');?></option>
                            <option value="14" <?php if ($namaz_time_array->asrtune == '14') echo 'selected' ?>><?php echo esc_html__('14 min','tmpray-islamic-helper');?></option>
                            <option value="15" <?php if ($namaz_time_array->asrtune == '15') echo 'selected' ?>><?php echo esc_html__('15 min','tmpray-islamic-helper');?></option>
                            <option value="16" <?php if ($namaz_time_array->asrtune == '16') echo 'selected' ?>><?php echo esc_html__('16 min','tmpray-islamic-helper');?></option>
                            <option value="17" <?php if ($namaz_time_array->asrtune == '17') echo 'selected' ?>><?php echo esc_html__('17 min','tmpray-islamic-helper');?></option>
                            <option value="18" <?php if ($namaz_time_array->asrtune == '18') echo 'selected' ?>><?php echo esc_html__('18 min','tmpray-islamic-helper');?></option>
                            <option value="19" <?php if ($namaz_time_array->asrtune == '19') echo 'selected' ?>><?php echo esc_html__('19 min','tmpray-islamic-helper');?></option>
                            <option value="20" <?php if ($namaz_time_array->asrtune == '20') echo 'selected' ?>><?php echo esc_html__('20 min','tmpray-islamic-helper');?></option>
                            <option value="21" <?php if ($namaz_time_array->asrtune == '21') echo 'selected' ?>><?php echo esc_html__('21 min','tmpray-islamic-helper');?></option>
                            <option value="22" <?php if ($namaz_time_array->asrtune == '22') echo 'selected' ?>><?php echo esc_html__('22 min','tmpray-islamic-helper');?></option>
                            <option value="23" <?php if ($namaz_time_array->asrtune == '23') echo 'selected' ?>><?php echo esc_html__('23 min','tmpray-islamic-helper');?></option>
                            <option value="24" <?php if ($namaz_time_array->asrtune == '24') echo 'selected' ?>><?php echo esc_html__('24 min','tmpray-islamic-helper');?></option>
                            <option value="25" <?php if ($namaz_time_array->asrtune == '25') echo 'selected' ?>><?php echo esc_html__('25 min','tmpray-islamic-helper');?></option>
                            <option value="26" <?php if ($namaz_time_array->asrtune == '26') echo 'selected' ?>><?php echo esc_html__('26 min','tmpray-islamic-helper');?></option>
                            <option value="27" <?php if ($namaz_time_array->asrtune == '27') echo 'selected' ?>><?php echo esc_html__('27 min','tmpray-islamic-helper');?></option>
                            <option value="28" <?php if ($namaz_time_array->asrtune == '28') echo 'selected' ?>><?php echo esc_html__('28 min','tmpray-islamic-helper');?></option>
                            <option value="29" <?php if ($namaz_time_array->asrtune == '29') echo 'selected' ?>><?php echo esc_html__('29 min','tmpray-islamic-helper');?></option>
                            <option value="30" <?php if ($namaz_time_array->asrtune == '30') echo 'selected' ?>><?php echo esc_html__('30 min','tmpray-islamic-helper');?></option>
                        </select>
                    </div>
                    <div class="tmpray--tuning-times-maghrib">
                        <span><?php echo esc_html__('Maghrib','tmpray-islamic-helper');?></span>
                        <select id="tmpray--tuning-times-maghrib" name="tmpray--tuning-times">
                            <option value="-30" <?php if ($namaz_time_array->maghribtune == '-30') echo 'selected' ?>><?php echo esc_html__('-30 min','tmpray-islamic-helper');?></option>
                            <option value="-29" <?php if ($namaz_time_array->maghribtune == '-29') echo 'selected' ?>><?php echo esc_html__('-29 min','tmpray-islamic-helper');?></option>
                            <option value="-28" <?php if ($namaz_time_array->maghribtune == '-28') echo 'selected' ?>><?php echo esc_html__('-28 min','tmpray-islamic-helper');?></option>
                            <option value="-27" <?php if ($namaz_time_array->maghribtune == '-27') echo 'selected' ?>><?php echo esc_html__('-27 min','tmpray-islamic-helper');?></option>
                            <option value="-26" <?php if ($namaz_time_array->maghribtune == '-26') echo 'selected' ?>><?php echo esc_html__('-26 min','tmpray-islamic-helper');?></option>
                            <option value="-25" <?php if ($namaz_time_array->maghribtune == '-25') echo 'selected' ?>><?php echo esc_html__('-25 min','tmpray-islamic-helper');?></option>
                            <option value="-24" <?php if ($namaz_time_array->maghribtune == '-24') echo 'selected' ?>><?php echo esc_html__('-24 min','tmpray-islamic-helper');?></option>
                            <option value="-23" <?php if ($namaz_time_array->maghribtune == '-23') echo 'selected' ?>><?php echo esc_html__('-23 min','tmpray-islamic-helper');?></option>
                            <option value="-22" <?php if ($namaz_time_array->maghribtune == '-22') echo 'selected' ?>><?php echo esc_html__('-22 min','tmpray-islamic-helper');?></option>
                            <option value="-21" <?php if ($namaz_time_array->maghribtune == '-21') echo 'selected' ?>><?php echo esc_html__('-21 min','tmpray-islamic-helper');?></option>
                            <option value="-20" <?php if ($namaz_time_array->maghribtune == '-20') echo 'selected' ?>><?php echo esc_html__('-20 min','tmpray-islamic-helper');?></option>
                            <option value="-19" <?php if ($namaz_time_array->maghribtune == '-19') echo 'selected' ?>><?php echo esc_html__('-19 min','tmpray-islamic-helper');?></option>
                            <option value="-18" <?php if ($namaz_time_array->maghribtune == '-18') echo 'selected' ?>><?php echo esc_html__('-18 min','tmpray-islamic-helper');?></option>
                            <option value="-17" <?php if ($namaz_time_array->maghribtune == '-17') echo 'selected' ?>><?php echo esc_html__('-17 min','tmpray-islamic-helper');?></option>
                            <option value="-16" <?php if ($namaz_time_array->maghribtune == '-16') echo 'selected' ?>><?php echo esc_html__('-16 min','tmpray-islamic-helper');?></option>
                            <option value="-15" <?php if ($namaz_time_array->maghribtune == '-15') echo 'selected' ?>><?php echo esc_html__('-15 min','tmpray-islamic-helper');?></option>
                            <option value="-14" <?php if ($namaz_time_array->maghribtune == '-14') echo 'selected' ?>><?php echo esc_html__('-14 min','tmpray-islamic-helper');?></option>
                            <option value="-13" <?php if ($namaz_time_array->maghribtune == '-13') echo 'selected' ?>><?php echo esc_html__('-13 min','tmpray-islamic-helper');?></option>
                            <option value="-12" <?php if ($namaz_time_array->maghribtune == '-12') echo 'selected' ?>><?php echo esc_html__('-12 min','tmpray-islamic-helper');?></option>
                            <option value="-11" <?php if ($namaz_time_array->maghribtune == '-11') echo 'selected' ?>><?php echo esc_html__('-11 min','tmpray-islamic-helper');?></option>
                            <option value="-10" <?php if ($namaz_time_array->maghribtune == '-10') echo 'selected' ?>><?php echo esc_html__('-10 min','tmpray-islamic-helper');?></option>
                            <option value="-9" <?php if ($namaz_time_array->maghribtune == '-9') echo 'selected' ?>><?php echo esc_html__('-9 min','tmpray-islamic-helper');?></option>
                            <option value="-8" <?php if ($namaz_time_array->maghribtune == '-8') echo 'selected' ?>><?php echo esc_html__('-8 min','tmpray-islamic-helper');?></option>
                            <option value="-7" <?php if ($namaz_time_array->maghribtune == '-7') echo 'selected' ?>><?php echo esc_html__('-7 min','tmpray-islamic-helper');?></option>
                            <option value="-6" <?php if ($namaz_time_array->maghribtune == '-6') echo 'selected' ?>><?php echo esc_html__('-6 min','tmpray-islamic-helper');?></option>
                            <option value="-5" <?php if ($namaz_time_array->maghribtune == '-5') echo 'selected' ?>><?php echo esc_html__('-5 min','tmpray-islamic-helper');?></option>
                            <option value="-4" <?php if ($namaz_time_array->maghribtune == '-4') echo 'selected' ?>><?php echo esc_html__('-4 min','tmpray-islamic-helper');?></option>
                            <option value="-3" <?php if ($namaz_time_array->maghribtune == '-3') echo 'selected' ?>><?php echo esc_html__('-3 min','tmpray-islamic-helper');?></option>
                            <option value="-2" <?php if ($namaz_time_array->maghribtune == '-2') echo 'selected' ?>><?php echo esc_html__('-2 min','tmpray-islamic-helper');?></option>
                            <option value="-1" <?php if ($namaz_time_array->maghribtune == '-1') echo 'selected' ?>><?php echo esc_html__('-1 min','tmpray-islamic-helper');?></option>
                            <option value="0" <?php if ($namaz_time_array->maghribtune == '0') echo 'selected' ?>><?php echo esc_html__('0 min','tmpray-islamic-helper');?></option>
                            <option value="1" <?php if ($namaz_time_array->maghribtune == '1') echo 'selected' ?>><?php echo esc_html__('1 min','tmpray-islamic-helper');?></option>
                            <option value="2" <?php if ($namaz_time_array->maghribtune == '2') echo 'selected' ?>><?php echo esc_html__('2 min','tmpray-islamic-helper');?></option>
                            <option value="3" <?php if ($namaz_time_array->maghribtune == '3') echo 'selected' ?>><?php echo esc_html__('3 min','tmpray-islamic-helper');?></option>
                            <option value="4" <?php if ($namaz_time_array->maghribtune == '4') echo 'selected' ?>><?php echo esc_html__('4 min','tmpray-islamic-helper');?></option>
                            <option value="5" <?php if ($namaz_time_array->maghribtune == '5') echo 'selected' ?>><?php echo esc_html__('5 min','tmpray-islamic-helper');?></option>
                            <option value="6" <?php if ($namaz_time_array->maghribtune == '6') echo 'selected' ?>><?php echo esc_html__('6 min','tmpray-islamic-helper');?></option>
                            <option value="7" <?php if ($namaz_time_array->maghribtune == '7') echo 'selected' ?>><?php echo esc_html__('7 min','tmpray-islamic-helper');?></option>
                            <option value="8" <?php if ($namaz_time_array->maghribtune == '8') echo 'selected' ?>><?php echo esc_html__('8 min','tmpray-islamic-helper');?></option>
                            <option value="9" <?php if ($namaz_time_array->maghribtune == '9') echo 'selected' ?>><?php echo esc_html__('9 min','tmpray-islamic-helper');?></option>
                            <option value="10" <?php if ($namaz_time_array->maghribtune == '10') echo 'selected' ?>><?php echo esc_html__('10 min','tmpray-islamic-helper');?></option>
                            <option value="11" <?php if ($namaz_time_array->maghribtune == '11') echo 'selected' ?>><?php echo esc_html__('11 min','tmpray-islamic-helper');?></option>
                            <option value="12" <?php if ($namaz_time_array->maghribtune == '12') echo 'selected' ?>><?php echo esc_html__('12 min','tmpray-islamic-helper');?></option>
                            <option value="13" <?php if ($namaz_time_array->maghribtune == '13') echo 'selected' ?>><?php echo esc_html__('13 min','tmpray-islamic-helper');?></option>
                            <option value="14" <?php if ($namaz_time_array->maghribtune == '14') echo 'selected' ?>><?php echo esc_html__('14 min','tmpray-islamic-helper');?></option>
                            <option value="15" <?php if ($namaz_time_array->maghribtune == '15') echo 'selected' ?>><?php echo esc_html__('15 min','tmpray-islamic-helper');?></option>
                            <option value="16" <?php if ($namaz_time_array->maghribtune == '16') echo 'selected' ?>><?php echo esc_html__('16 min','tmpray-islamic-helper');?></option>
                            <option value="17" <?php if ($namaz_time_array->maghribtune == '17') echo 'selected' ?>><?php echo esc_html__('17 min','tmpray-islamic-helper');?></option>
                            <option value="18" <?php if ($namaz_time_array->maghribtune == '18') echo 'selected' ?>><?php echo esc_html__('18 min','tmpray-islamic-helper');?></option>
                            <option value="19" <?php if ($namaz_time_array->maghribtune == '19') echo 'selected' ?>><?php echo esc_html__('19 min','tmpray-islamic-helper');?></option>
                            <option value="20" <?php if ($namaz_time_array->maghribtune == '20') echo 'selected' ?>><?php echo esc_html__('20 min','tmpray-islamic-helper');?></option>
                            <option value="21" <?php if ($namaz_time_array->maghribtune == '21') echo 'selected' ?>><?php echo esc_html__('21 min','tmpray-islamic-helper');?></option>
                            <option value="22" <?php if ($namaz_time_array->maghribtune == '22') echo 'selected' ?>><?php echo esc_html__('22 min','tmpray-islamic-helper');?></option>
                            <option value="23" <?php if ($namaz_time_array->maghribtune == '23') echo 'selected' ?>><?php echo esc_html__('23 min','tmpray-islamic-helper');?></option>
                            <option value="24" <?php if ($namaz_time_array->maghribtune == '24') echo 'selected' ?>><?php echo esc_html__('24 min','tmpray-islamic-helper');?></option>
                            <option value="25" <?php if ($namaz_time_array->maghribtune == '25') echo 'selected' ?>><?php echo esc_html__('25 min','tmpray-islamic-helper');?></option>
                            <option value="26" <?php if ($namaz_time_array->maghribtune == '26') echo 'selected' ?>><?php echo esc_html__('26 min','tmpray-islamic-helper');?></option>
                            <option value="27" <?php if ($namaz_time_array->maghribtune == '27') echo 'selected' ?>><?php echo esc_html__('27 min','tmpray-islamic-helper');?></option>
                            <option value="28" <?php if ($namaz_time_array->maghribtune == '28') echo 'selected' ?>><?php echo esc_html__('28 min','tmpray-islamic-helper');?></option>
                            <option value="29" <?php if ($namaz_time_array->maghribtune == '29') echo 'selected' ?>><?php echo esc_html__('29 min','tmpray-islamic-helper');?></option>
                            <option value="30" <?php if ($namaz_time_array->maghribtune == '30') echo 'selected' ?>><?php echo esc_html__('30 min','tmpray-islamic-helper');?></option>
                        </select>
                    </div>
                    <div class="tmpray--tuning-times-isha">
                        <span><?php echo esc_html__('Isha','tmpray-islamic-helper');?></span>
                        <select id="tmpray--tuning-times-isha" name="tmpray--tuning-times">
                            <option value="-30" <?php if ($namaz_time_array->ishatune == '-30') echo 'selected' ?>><?php echo esc_html__('-30 min','tmpray-islamic-helper');?></option>
                            <option value="-29" <?php if ($namaz_time_array->ishatune == '-29') echo 'selected' ?>><?php echo esc_html__('-29 min','tmpray-islamic-helper');?></option>
                            <option value="-28" <?php if ($namaz_time_array->ishatune == '-28') echo 'selected' ?>><?php echo esc_html__('-28 min','tmpray-islamic-helper');?></option>
                            <option value="-27" <?php if ($namaz_time_array->ishatune == '-27') echo 'selected' ?>><?php echo esc_html__('-27 min','tmpray-islamic-helper');?></option>
                            <option value="-26" <?php if ($namaz_time_array->ishatune == '-26') echo 'selected' ?>><?php echo esc_html__('-26 min','tmpray-islamic-helper');?></option>
                            <option value="-25" <?php if ($namaz_time_array->ishatune == '-25') echo 'selected' ?>><?php echo esc_html__('-25 min','tmpray-islamic-helper');?></option>
                            <option value="-24" <?php if ($namaz_time_array->ishatune == '-24') echo 'selected' ?>><?php echo esc_html__('-24 min','tmpray-islamic-helper');?></option>
                            <option value="-23" <?php if ($namaz_time_array->ishatune == '-23') echo 'selected' ?>><?php echo esc_html__('-23 min','tmpray-islamic-helper');?></option>
                            <option value="-22" <?php if ($namaz_time_array->ishatune == '-22') echo 'selected' ?>><?php echo esc_html__('-22 min','tmpray-islamic-helper');?></option>
                            <option value="-21" <?php if ($namaz_time_array->ishatune == '-21') echo 'selected' ?>><?php echo esc_html__('-21 min','tmpray-islamic-helper');?></option>
                            <option value="-20" <?php if ($namaz_time_array->ishatune == '-20') echo 'selected' ?>><?php echo esc_html__('-20 min','tmpray-islamic-helper');?></option>
                            <option value="-19" <?php if ($namaz_time_array->ishatune == '-19') echo 'selected' ?>><?php echo esc_html__('-19 min','tmpray-islamic-helper');?></option>
                            <option value="-18" <?php if ($namaz_time_array->ishatune == '-18') echo 'selected' ?>><?php echo esc_html__('-18 min','tmpray-islamic-helper');?></option>
                            <option value="-17" <?php if ($namaz_time_array->ishatune == '-17') echo 'selected' ?>><?php echo esc_html__('-17 min','tmpray-islamic-helper');?></option>
                            <option value="-16" <?php if ($namaz_time_array->ishatune == '-16') echo 'selected' ?>><?php echo esc_html__('-16 min','tmpray-islamic-helper');?></option>
                            <option value="-15" <?php if ($namaz_time_array->ishatune == '-15') echo 'selected' ?>><?php echo esc_html__('-15 min','tmpray-islamic-helper');?></option>
                            <option value="-14" <?php if ($namaz_time_array->ishatune == '-14') echo 'selected' ?>><?php echo esc_html__('-14 min','tmpray-islamic-helper');?></option>
                            <option value="-13" <?php if ($namaz_time_array->ishatune == '-13') echo 'selected' ?>><?php echo esc_html__('-13 min','tmpray-islamic-helper');?></option>
                            <option value="-12" <?php if ($namaz_time_array->ishatune == '-12') echo 'selected' ?>><?php echo esc_html__('-12 min','tmpray-islamic-helper');?></option>
                            <option value="-11" <?php if ($namaz_time_array->ishatune == '-11') echo 'selected' ?>><?php echo esc_html__('-11 min','tmpray-islamic-helper');?></option>
                            <option value="-10" <?php if ($namaz_time_array->ishatune == '-10') echo 'selected' ?>><?php echo esc_html__('-10 min','tmpray-islamic-helper');?></option>
                            <option value="-9" <?php if ($namaz_time_array->ishatune == '-9') echo 'selected' ?>><?php echo esc_html__('-9 min','tmpray-islamic-helper');?></option>
                            <option value="-8" <?php if ($namaz_time_array->ishatune == '-8') echo 'selected' ?>><?php echo esc_html__('-8 min','tmpray-islamic-helper');?></option>
                            <option value="-7" <?php if ($namaz_time_array->ishatune == '-7') echo 'selected' ?>><?php echo esc_html__('-7 min','tmpray-islamic-helper');?></option>
                            <option value="-6" <?php if ($namaz_time_array->ishatune == '-6') echo 'selected' ?>><?php echo esc_html__('-6 min','tmpray-islamic-helper');?></option>
                            <option value="-5" <?php if ($namaz_time_array->ishatune == '-5') echo 'selected' ?>><?php echo esc_html__('-5 min','tmpray-islamic-helper');?></option>
                            <option value="-4" <?php if ($namaz_time_array->ishatune == '-4') echo 'selected' ?>><?php echo esc_html__('-4 min','tmpray-islamic-helper');?></option>
                            <option value="-3" <?php if ($namaz_time_array->ishatune == '-3') echo 'selected' ?>><?php echo esc_html__('-3 min','tmpray-islamic-helper');?></option>
                            <option value="-2" <?php if ($namaz_time_array->ishatune == '-2') echo 'selected' ?>><?php echo esc_html__('-2 min','tmpray-islamic-helper');?></option>
                            <option value="-1" <?php if ($namaz_time_array->ishatune == '-1') echo 'selected' ?>><?php echo esc_html__('-1 min','tmpray-islamic-helper');?></option>
                            <option value="0" <?php if ($namaz_time_array->ishatune == '0') echo 'selected' ?>><?php echo esc_html__('0 min','tmpray-islamic-helper');?></option>
                            <option value="1" <?php if ($namaz_time_array->ishatune == '1') echo 'selected' ?>><?php echo esc_html__('1 min','tmpray-islamic-helper');?></option>
                            <option value="2" <?php if ($namaz_time_array->ishatune == '2') echo 'selected' ?>><?php echo esc_html__('2 min','tmpray-islamic-helper');?></option>
                            <option value="3" <?php if ($namaz_time_array->ishatune == '3') echo 'selected' ?>><?php echo esc_html__('3 min','tmpray-islamic-helper');?></option>
                            <option value="4" <?php if ($namaz_time_array->ishatune == '4') echo 'selected' ?>><?php echo esc_html__('4 min','tmpray-islamic-helper');?></option>
                            <option value="5" <?php if ($namaz_time_array->ishatune == '5') echo 'selected' ?>><?php echo esc_html__('5 min','tmpray-islamic-helper');?></option>
                            <option value="6" <?php if ($namaz_time_array->ishatune == '6') echo 'selected' ?>><?php echo esc_html__('6 min','tmpray-islamic-helper');?></option>
                            <option value="7" <?php if ($namaz_time_array->ishatune == '7') echo 'selected' ?>><?php echo esc_html__('7 min','tmpray-islamic-helper');?></option>
                            <option value="8" <?php if ($namaz_time_array->ishatune == '8') echo 'selected' ?>><?php echo esc_html__('8 min','tmpray-islamic-helper');?></option>
                            <option value="9" <?php if ($namaz_time_array->ishatune == '9') echo 'selected' ?>><?php echo esc_html__('9 min','tmpray-islamic-helper');?></option>
                            <option value="10" <?php if ($namaz_time_array->ishatune == '10') echo 'selected' ?>><?php echo esc_html__('10 min','tmpray-islamic-helper');?></option>
                            <option value="11" <?php if ($namaz_time_array->ishatune == '11') echo 'selected' ?>><?php echo esc_html__('11 min','tmpray-islamic-helper');?></option>
                            <option value="12" <?php if ($namaz_time_array->ishatune == '12') echo 'selected' ?>><?php echo esc_html__('12 min','tmpray-islamic-helper');?></option>
                            <option value="13" <?php if ($namaz_time_array->ishatune == '13') echo 'selected' ?>><?php echo esc_html__('13 min','tmpray-islamic-helper');?></option>
                            <option value="14" <?php if ($namaz_time_array->ishatune == '14') echo 'selected' ?>><?php echo esc_html__('14 min','tmpray-islamic-helper');?></option>
                            <option value="15" <?php if ($namaz_time_array->ishatune == '15') echo 'selected' ?>><?php echo esc_html__('15 min','tmpray-islamic-helper');?></option>
                            <option value="16" <?php if ($namaz_time_array->ishatune == '16') echo 'selected' ?>><?php echo esc_html__('16 min','tmpray-islamic-helper');?></option>
                            <option value="17" <?php if ($namaz_time_array->ishatune == '17') echo 'selected' ?>><?php echo esc_html__('17 min','tmpray-islamic-helper');?></option>
                            <option value="18" <?php if ($namaz_time_array->ishatune == '18') echo 'selected' ?>><?php echo esc_html__('18 min','tmpray-islamic-helper');?></option>
                            <option value="19" <?php if ($namaz_time_array->ishatune == '19') echo 'selected' ?>><?php echo esc_html__('19 min','tmpray-islamic-helper');?></option>
                            <option value="20" <?php if ($namaz_time_array->ishatune == '20') echo 'selected' ?>><?php echo esc_html__('20 min','tmpray-islamic-helper');?></option>
                            <option value="21" <?php if ($namaz_time_array->ishatune == '21') echo 'selected' ?>><?php echo esc_html__('21 min','tmpray-islamic-helper');?></option>
                            <option value="22" <?php if ($namaz_time_array->ishatune == '22') echo 'selected' ?>><?php echo esc_html__('22 min','tmpray-islamic-helper');?></option>
                            <option value="23" <?php if ($namaz_time_array->ishatune == '23') echo 'selected' ?>><?php echo esc_html__('23 min','tmpray-islamic-helper');?></option>
                            <option value="24" <?php if ($namaz_time_array->ishatune == '24') echo 'selected' ?>><?php echo esc_html__('24 min','tmpray-islamic-helper');?></option>
                            <option value="25" <?php if ($namaz_time_array->ishatune == '25') echo 'selected' ?>><?php echo esc_html__('25 min','tmpray-islamic-helper');?></option>
                            <option value="26" <?php if ($namaz_time_array->ishatune == '26') echo 'selected' ?>><?php echo esc_html__('26 min','tmpray-islamic-helper');?></option>
                            <option value="27" <?php if ($namaz_time_array->ishatune == '27') echo 'selected' ?>><?php echo esc_html__('27 min','tmpray-islamic-helper');?></option>
                            <option value="28" <?php if ($namaz_time_array->ishatune == '28') echo 'selected' ?>><?php echo esc_html__('28 min','tmpray-islamic-helper');?></option>
                            <option value="29" <?php if ($namaz_time_array->ishatune == '29') echo 'selected' ?>><?php echo esc_html__('29 min','tmpray-islamic-helper');?></option>
                            <option value="30" <?php if ($namaz_time_array->ishatune == '30') echo 'selected' ?>><?php echo esc_html__('30 min','tmpray-islamic-helper');?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="tmpray--timezone-contain">
                <span><?php echo esc_html__('Timezone','tmpray-islamic-helper');?></span>
                <select id="tmpray--timezone" class="tmpray--timezone">
                    <option value="-12" <?php if ($namaz_time_array->timezone == '-12') echo 'selected' ?>><?php echo esc_html__('UTC-12:00','tmpray-islamic-helper');?></option>
                    <option value="-11" <?php if ($namaz_time_array->timezone == '-11') echo 'selected' ?>><?php echo esc_html__('UTC-11:00','tmpray-islamic-helper');?></option>
                    <option value="-10.5" <?php if ($namaz_time_array->timezone == '-10.5') echo 'selected' ?>><?php echo esc_html__('UTC-10.5','tmpray-islamic-helper');?></option>
                    <option value="-10" <?php if ($namaz_time_array->timezone == '-10') echo 'selected' ?>><?php echo esc_html__('UTC-10:00','tmpray-islamic-helper');?></option>
                    <option value="-9.5" <?php if ($namaz_time_array->timezone == '-9.5') echo 'selected' ?>><?php echo esc_html__('UTC-9.5','tmpray-islamic-helper');?></option>
                    <option value="-9" <?php if ($namaz_time_array->timezone == '-9') echo 'selected' ?>><?php echo esc_html__('UTC-09:00','tmpray-islamic-helper');?></option>
                    <option value="-8.5" <?php if ($namaz_time_array->timezone == '-8.5') echo 'selected' ?>><?php echo esc_html__('UTC-8.5','tmpray-islamic-helper');?></option>
                    <option value="-8" <?php if ($namaz_time_array->timezone == '-8') echo 'selected' ?>><?php echo esc_html__('UTC-08:00','tmpray-islamic-helper');?></option>
                    <option value="-7.5" <?php if ($namaz_time_array->timezone == '-7.5') echo 'selected' ?>><?php echo esc_html__('UTC-7.5','tmpray-islamic-helper');?></option>
                    <option value="-7" <?php if ($namaz_time_array->timezone == '-7') echo 'selected' ?>><?php echo esc_html__('UTC-07:00','tmpray-islamic-helper');?></option>
                    <option value="-6.5" <?php if ($namaz_time_array->timezone == '-6.5') echo 'selected' ?>><?php echo esc_html__('UTC-6.5','tmpray-islamic-helper');?></option>
                    <option value="-6" <?php if ($namaz_time_array->timezone == '-6') echo 'selected' ?>><?php echo esc_html__('UTC-06:00','tmpray-islamic-helper');?></option>
                    <option value="-5.5" <?php if ($namaz_time_array->timezone == '-5.5') echo 'selected' ?>><?php echo esc_html__('UTC-5.5','tmpray-islamic-helper');?></option>
                    <option value="-5" <?php if ($namaz_time_array->timezone == '-5') echo 'selected' ?>><?php echo esc_html__('UTC-05:00','tmpray-islamic-helper');?></option>
                    <option value="-4.5" <?php if ($namaz_time_array->timezone == '-4.5') echo 'selected' ?>><?php echo esc_html__('UTC-4.5','tmpray-islamic-helper');?></option>
                    <option value="-4" <?php if ($namaz_time_array->timezone == '-4') echo 'selected' ?>><?php echo esc_html__('UTC-04:00','tmpray-islamic-helper');?></option>
                    <option value="-3.5" <?php if ($namaz_time_array->timezone == '-3.5') echo 'selected' ?>><?php echo esc_html__('UTC-3.5','tmpray-islamic-helper');?></option>
                    <option value="-3" <?php if ($namaz_time_array->timezone == '-3') echo 'selected' ?>><?php echo esc_html__('UTC-03:00','tmpray-islamic-helper');?></option>
                    <option value="-2.5" <?php if ($namaz_time_array->timezone == '-2.5') echo 'selected' ?>><?php echo esc_html__('UTC-2.5','tmpray-islamic-helper');?></option>
                    <option value="-2" <?php if ($namaz_time_array->timezone == '-2') echo 'selected' ?>><?php echo esc_html__('UTC-02:00','tmpray-islamic-helper');?></option>
                    <option value="-1.5" <?php if ($namaz_time_array->timezone == '-1.5') echo 'selected' ?>><?php echo esc_html__('UTC-1.5','tmpray-islamic-helper');?></option>
                    <option value="-1" <?php if ($namaz_time_array->timezone == '-1') echo 'selected' ?>><?php echo esc_html__('UTC-01:00','tmpray-islamic-helper');?></option>
                    <option value="-0.5" <?php if ($namaz_time_array->timezone == '-0.5') echo 'selected' ?>><?php echo esc_html__('UTC-0.5','tmpray-islamic-helper');?></option>
                    <option value="0" <?php if ($namaz_time_array->timezone == '0') echo 'selected' ?>><?php echo esc_html__('UTC+00:00','tmpray-islamic-helper');?></option>
                    <option value="0.5" <?php if ($namaz_time_array->timezone == '0.5') echo 'selected' ?>><?php echo esc_html__('UTC+0.5','tmpray-islamic-helper');?></option>
                    <option value="1" <?php if ($namaz_time_array->timezone == '1') echo 'selected' ?>><?php echo esc_html__('UTC+01:00','tmpray-islamic-helper');?></option>
                    <option value="1.5" <?php if ($namaz_time_array->timezone == '1.5') echo 'selected' ?>><?php echo esc_html__('UTC+1.5','tmpray-islamic-helper');?></option>
                    <option value="2" <?php if ($namaz_time_array->timezone == '2') echo 'selected' ?>><?php echo esc_html__('UTC+02:00','tmpray-islamic-helper');?></option>
                    <option value="2.5" <?php if ($namaz_time_array->timezone == '2.5') echo 'selected' ?>><?php echo esc_html__('UTC+2.5','tmpray-islamic-helper');?></option>
                    <option value="3" <?php if ($namaz_time_array->timezone == '3') echo 'selected' ?>><?php echo esc_html__('UTC+03:00','tmpray-islamic-helper');?></option>
                    <option value="3.5" <?php if ($namaz_time_array->timezone == '3.5') echo 'selected' ?>><?php echo esc_html__('UTC+3.5','tmpray-islamic-helper');?></option>
                    <option value="4" <?php if ($namaz_time_array->timezone == '4') echo 'selected' ?>><?php echo esc_html__('UTC+04:00','tmpray-islamic-helper');?></option>
                    <option value="4.5" <?php if ($namaz_time_array->timezone == '4.5') echo 'selected' ?>><?php echo esc_html__('UTC+4.5','tmpray-islamic-helper');?></option>
                    <option value="5" <?php if ($namaz_time_array->timezone == '5') echo 'selected' ?>><?php echo esc_html__('UTC+05:00','tmpray-islamic-helper');?></option>
                    <option value="5.5" <?php if ($namaz_time_array->timezone == '5.5') echo 'selected' ?>><?php echo esc_html__('UTC+5.5','tmpray-islamic-helper');?></option>
                    <option value="6" <?php if ($namaz_time_array->timezone == '6') echo 'selected' ?>><?php echo esc_html__('UTC+06:00','tmpray-islamic-helper');?></option>
                    <option value="6.5" <?php if ($namaz_time_array->timezone == '6.5') echo 'selected' ?>><?php echo esc_html__('UTC+6.5','tmpray-islamic-helper');?></option>
                    <option value="7" <?php if ($namaz_time_array->timezone == '7') echo 'selected' ?>><?php echo esc_html__('UTC+07:00','tmpray-islamic-helper');?></option>
                    <option value="7.5" <?php if ($namaz_time_array->timezone == '7.5') echo 'selected' ?>><?php echo esc_html__('UTC+7.5','tmpray-islamic-helper');?></option>
                    <option value="8" <?php if ($namaz_time_array->timezone == '8') echo 'selected' ?>><?php echo esc_html__('UTC+08:00','tmpray-islamic-helper');?></option>
                    <option value="8.5" <?php if ($namaz_time_array->timezone == '8.5') echo 'selected' ?>><?php echo esc_html__('UTC+8.5','tmpray-islamic-helper');?></option>
                    <option value="9" <?php if ($namaz_time_array->timezone == '9') echo 'selected' ?>><?php echo esc_html__('UTC+09:00','tmpray-islamic-helper');?></option>
                    <option value="9.5" <?php if ($namaz_time_array->timezone == '9.5') echo 'selected' ?>><?php echo esc_html__('UTC+9.5','tmpray-islamic-helper');?></option>
                    <option value="10" <?php if ($namaz_time_array->timezone == '10') echo 'selected' ?>><?php echo esc_html__('UTC+10:00','tmpray-islamic-helper');?></option>
                    <option value="10.5" <?php if ($namaz_time_array->timezone == '10.5') echo 'selected' ?>><?php echo esc_html__('UTC+10.5','tmpray-islamic-helper');?></option>
                    <option value="11" <?php if ($namaz_time_array->timezone == '11') echo 'selected' ?>><?php echo esc_html__('UTC+11:00','tmpray-islamic-helper');?></option>
                    <option value="11.5" <?php if ($namaz_time_array->timezone == '11.5') echo 'selected' ?>><?php echo esc_html__('UTC+11.5','tmpray-islamic-helper');?></option>
                    <option value="12" <?php if ($namaz_time_array->timezone == '12') echo 'selected' ?>><?php echo esc_html__('UTC+12:00','tmpray-islamic-helper');?></option>
                    <option value="12.5" <?php if ($namaz_time_array->timezone == '12.5') echo 'selected' ?>><?php echo esc_html__('UTC+12.5','tmpray-islamic-helper');?></option>
                    <option value="13" <?php if ($namaz_time_array->timezone == '13') echo 'selected' ?>><?php echo esc_html__('UTC+13:00','tmpray-islamic-helper');?></option>
                    <option value="13.5" <?php if ($namaz_time_array->timezone == '13.5') echo 'selected' ?>><?php echo esc_html__('UTC+13.5','tmpray-islamic-helper');?></option>
                    <option value="14" <?php if ($namaz_time_array->timezone == '14') echo 'selected' ?>><?php echo esc_html__('UTC+14:00','tmpray-islamic-helper');?></option>
                    <option value="14.5" <?php if ($namaz_time_array->timezone == '14.5') echo 'selected' ?>><?php echo esc_html__('UTC+14.5','tmpray-islamic-helper');?></option>
                </select>
            </div>

            <div class="tmpray--coordinates-contain">
                <span><?php echo esc_html__('City Coordinates','tmpray-islamic-helper');?></span>
                <input type="text" class="tmpray--city" id="tmpray--city" value="<?php echo esc_html($namaz_time_array->city,'tmpray-islamic-helper');?>">
                <div class="tmpray--coordinates">
                    <div class="tmpray--coordinates-lat">
                        <span><?php echo esc_html__('Latitude','tmpray-islamic-helper');?></span>
                        <input type="text" id="tmpray--latitude" class="tmpray--latitude" value="<?php echo esc_html($namaz_time_array->latitude,'tmpray-islamic-helper');?>" >
                    </div>
                    <div class="tmpray--coordinates-long">
                        <span><?php echo esc_html__('Longitude','tmpray-islamic-helper');?></span>
                        <input type="text" id="tmpray--longitude" class="tmpray--longitude" value="<?php echo esc_html($namaz_time_array->longitude,'tmpray-islamic-helper');?>" >
                    </div>
                </div>
            </div>
            <div id='tmpray--method-button_container'>
                <button id='tmpray--method-save' type="button" class="tmpray--method-save"><?php echo esc_html__('Save','tmpray-islamic-helper');?></button>
                <span id="tmpray--method-saved"></span>
                <span id="tmpray--method-error"></span>
            </div>
        </form>
        <div class="tmpray--table-select-month">
            <select id="tmpray--table-month_title" name="tmpray--table-month_title">
                <option value="1"><?php echo esc_html__('January','tmpray-islamic-helper');?></option>
                <option value="2"><?php echo esc_html__('February','tmpray-islamic-helper');?></option>
                <option value="3"><?php echo esc_html__('March','tmpray-islamic-helper');?></option>
                <option value="4"><?php echo esc_html__('April','tmpray-islamic-helper');?></option>
                <option value="5"><?php echo esc_html__('May','tmpray-islamic-helper');?></option>
                <option value="6"><?php echo esc_html__('June','tmpray-islamic-helper');?></option>
                <option value="7"><?php echo esc_html__('July','tmpray-islamic-helper');?></option>
                <option value="8"><?php echo esc_html__('August','tmpray-islamic-helper');?></option>
                <option value="9"><?php echo esc_html__('September','tmpray-islamic-helper');?></option>
                <option value="10"><?php echo esc_html__('October','tmpray-islamic-helper');?></option>
                <option value="11"><?php echo esc_html__('November','tmpray-islamic-helper');?></option>
                <option value="12"><?php echo esc_html__('December','tmpray-islamic-helper');?></option>
            </select>
            <table class="tmpray--table-result" id="tmpray--table-result">

            </table>
        </div>

    </div>

</div>



