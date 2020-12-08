<?php
namespace Elementor;
class ROI_Calculator_Widget extends Widget_Base {

    public function get_name() {
        return  'roi-calculator-id';
    }

    public function get_title() {
        return esc_html__( 'ROI Calculator Form', 'roi-calculator-widget' );
    }

    public function get_script_depends() {
        return [
            'roi-calc-script'
        ];
    }

    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return [ 'andersjson-elementor' ];
    }

    public function _register_controls() {
        // Content Settings
        $this->start_controls_section(
            'checklist_settings',
            [
                'label' => __( 'Content Settings', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            // Checklist Repeater
            $repeater = new \Elementor\Repeater();
            $repeater->add_control(
                'checklist_text',
                [
                    'label' => __( 'Checklist Text', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( '' , 'roi-calculator-widget' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'checklist_icon',
                [
                    'label' => __( 'Checklist Icon', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-check',
                        'library' => 'regular',
                    ],
                ]
            );

            $this->add_control(
                'checklist',
                [
                    'label' => __( 'Checklist', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'checklist_text' => __( 'Spending at least 3 hours/day maintaining sites', 'roi-calculator-widget' ),
                        ],
                        [
                            'checklist_text' => __( 'Its my fulltime job', 'roi-calculator-widget' ),
                        ],
                        [
                            'checklist_text' => __( 'Travelling more than 30 minutes to work', 'roi-calculator-widget' ),
                        ],
                        [
                            'checklist_text' => __( 'Have 5 or more employees', 'roi-calculator-widget' ),
                        ],
                    ],
                    'title_field' => '{{{ checklist_text }}}',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'first_label_settings',
            [
                'label' => __( 'First Label Settings', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // First Label Text
        $this->add_control(
            'first_label_text',
            [
                'label' => __( 'First Label text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Label text', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for label', 'roi-calculator-widget' ),
            ]
        );

        // First Label Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'first_label_typography',
				'label' => __( 'Typography', 'plugin-domain' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .first-label',
			]
        );
        
        $this->add_control(
            'first_label_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        // First Label Tip
        $this->add_control(
            'show_first_label_tip',
            [
                'label' => __( 'Show First Label Tip', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'your-plugin' ),
                'label_off' => __( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // First Tip text
        $this->add_control(
            'first_tip_text',
            [
                'label' => __( 'First Tip Text', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Explanation and tip goes here', 'plugin-domain' ),
                'placeholder' => __( 'Type your tip here', 'plugin-domain' ),
                'condition' => [
                    'show_first_label_tip' => 'yes'
                ]
            ]
        );

        // First Tip Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'first_tip_typography',
				'label' => __( 'Typography', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .first-tip',
			]
        );

        
        $this->end_controls_section();

        //Trigger styles control-function
        $this->style_tab();
    }

    private function style_tab() {
         // Wrapper Style Settings
         $this->start_controls_section(
            'wrapper_style_section',
            [
                'label' => __( 'Wrapper', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            // Padding
            $this->add_responsive_control(
                'wrapper_padding',
                [
                    'label' => __( 'Padding', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'rem' ],
                    'description' => 'Default: ( 40px 40px 40px 40px )',
                    'default' => [
                        'top' => 40,
                        'right' => 40,
                        'bottom' => 40,
                        'left' => 40,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .roi-outer-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Border Type
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'wrapper_border',
                    'label' => __( 'Border', 'roi-calculator-widget' ),
                    'selector' => '{{WRAPPER}} .roi-outer-wrapper',
                ]
            );

            // Border Radius
            $this->add_responsive_control(
                'wrapper_border_radius',
                [
                    'label' => __( 'Border Radius', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'rem' ],
                    'description' => 'Default: ( 10px 10px 10px 10px )',
                    'default' => [
                        'top' => 10,
                        'right' => 10,
                        'bottom' => 10,
                        'left' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .roi-outer-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

                    ],
                ]
            );

            // Box Shadow
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'wrapper_box_shadow',
                    'label' => __( 'Box Shadow', 'roi-calculator-widget' ),
                    'selector' => '{{WRAPPER}} .roi-outer-wrapper',
                ]
            );

            // Background Color
            $this->add_control(
                'wrapper_backgorund_color',
                [
                    'label' => __( 'Background Color', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#FFFFFF',
                    'description' => 'Default: ( #FFFFFF ) ',
                    'selectors' => [
                        '{{WRAPPER}} .roi-outer-wrapper ' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();

        // Label Style Settings
        $this->start_controls_section(
            'first_label_style_section',
            [
                'label' => __( 'Label', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            // Text Color
            $this->add_control(
                'label_text_color',
                [
                    'label' => __( 'Text Color', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#54595f',
                    'description' => 'Default: ( #54595f ) ',
                    'selectors' => [
                        '{{WRAPPER}} .roi-left__label' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'tip_icon_hr',
                [
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ]
            );

            // Tip-Icon Color
            $this->add_control(
                'tip_icon_color',
                [
                    'label' => __( 'Tip-Icon Color', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#54595f',
                    'description' => 'Default: ( #54595f ) ',
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip-trigger' => 'border: 2px solid {{VALUE}};',
                        '{{WRAPPER}} .roi-tip-trigger p' => 'color: {{VALUE}};'
                    ],
                ]
            );

            $this->add_control(
                'tip_hr',
                [
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ]
            );

            //Tip text-color
            $this->add_control(
                'tip_text_color',
                [
                    'label' => __( 'Tip Text Color', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#54595f',
                    'description' => 'Default: ( #54595f ) ',
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Tip Padding
            $this->add_responsive_control(
                'tip_padding',
                [
                    'label' => __( 'Tip Padding', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'rem' ],
                    'description' => 'Default: ( 15px 20px 15px 20px )',
                    'default' => [
                        'top' => 15,
                        'right' => 20,
                        'bottom' => 15,
                        'left' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Tip Border Radius
            $this->add_responsive_control(
                'tip_border_radius',
                [
                    'label' => __( 'Border Radius', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'rem' ],
                    'description' => 'Default: ( 3px 3px 3px 3px )',
                    'default' => [
                        'top' => 3,
                        'right' => 3,
                        'bottom' => 3,
                        'left' => 3,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

                    ],
                ]
            );

            // Tip Box Shadow
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'tip_box_shadow',
                    'label' => __( 'Tip Box Shadow', 'roi-calculator-widget' ),
                    'selector' => '{{WRAPPER}} .roi-tip',
                ]
            );

            // Tip Background Color
            $this->add_control(
                'tip_backgorund_color',
                [
                    'label' => __( 'Tip Background Color', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#FFFFFF',
                    'description' => 'Default: ( #FFFFFF ) ',
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip ' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        /*
        $this->add_render_attribute(
            'roi_calculator_options',
            [
                'id'          => 'logo-carousel-' . $this->get_id(),
                'data-loop'   => $settings[ 'loop' ],
                'data-dots'   => $settings[ 'dots' ],
                'data-navs'   => $settings[ 'navs' ],
                'data-margin' => $settings[ 'margin' ],
            ]
        );
    */
        ?>


        <!-- *********************** -->
        <div class="roi-outer-wrapper">
            <section class="roi-inner-wrapper">
                    <form class="roi-calculation-form" id="roi-calculation-form">
                        <fieldset class="roi-row">
                            <label class="roi-left">
                            <p class="roi-left__label first-label"><?php echo $settings[ 'first_label_text' ]; ?></p>
                            <?php if( $settings[ 'show_first_label_tip' ] == 'yes') : ?>
                                <span class="roi-tip-trigger"><p>?</p></span>
                                <span class="roi-tip first-tip">
                                    <p><?php echo $settings[ 'first_tip_text' ]; ?></p>
                                </span>
                            <?php endif; ?>
                            </label>
                            <div class="roi-right">
                                <p>TEST--If you manage more than 30 sites/month, you’re ready for your very own custom plan. Email <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="097a68656c7a496e6c7d6f65707e616c6c65276a6664">[email&#160;protected]</a> and we’ll generate a tailor-made ROI report and quote for you!</p>

<!-- ******************************** Slider 
                                <div class="roi-thumb-contain">
                                    <span type="range" id="js-roi-thumb" class="roi-thumb"></span>
                                </div>
                                <input type="range" id="js-roi-slider" class="range roi-slider" step="1" min="5" max="30" value="10">
                                <ul class="roi-slider-labels">
                                    <li>
                                    <a href="#" class="js-roi-label" data-value="5">5</a>
                                    </li>
                                </ul>
-->
                            </div>
                        </fieldset>
                    
                        <fieldset class="roi-row">
                            <label class="roi-left">
                                <p class="roi-left__label">Which of the following tasks do you handle for your clients?</p>
                            </label>
                            <div class="roi-right">
                                <ul class="roi-checklist">
                                <?php
                                foreach( $settings[ 'checklist' ] as $item ) : ?>
                                    <label class="roi-checklist__label">
                                        <li>
                                            <input type="checkbox" name="struggles[]" class="roi-checklist__input" value="<?php echo $item[ 'checklist_text' ]; ?>">
                                            <span class="roi-checklist__icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $item['checklist_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </span>
                                            <?php echo $item[ 'checklist_text' ]; ?>
                                        </li>
                                    </label>
                                <?php endforeach; ?>
                                <!--
                                    <li>
                                    <label class="roi-checklist__label">
                                        <input type="checkbox" name="struggles[]" class="roi-checklist__mark" value="Dealing with downtime">
                                        <span>
                                        </span>
                                        Dealing with downtime
                                    </label>
                                    </li>
                                    -->
                                </ul>
                            </div>
                        </fieldset>
                    
                        <fieldset class="roi-row">
                            <label class="roi-left">
                                <p class="roi-left__label">How many hours (per month) do you spend managing all of the above tasks for just one of your sites?</p>
                                <span class="roi-tip-trigger"><p>?</p></span>
                                <span class="roi-tip">
                                    <p>Consider how much time it takes you or your team to deal with malware, downtime, WordPress updates, or slow site speeds. For each site, how much time do you spend on these issues? </p>
                                </span>
                            </label>
                            <div class="roi-right">
                                <p>TEST If you manage more than 30 sites/month, you’re ready for your very own custom plan. Email <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="097a68656c7a496e6c7d6f65707e616c6c65276a6664">[email&#160;protected]</a> and we’ll generate a tailor-made ROI report and quote for you!</p>

<!-- ******************************** Slider 
                                <div class="roi-thumb-contain">
                                    <span type="range" id="js-roi-thumb1" class="roi-thumb"></span>
                                </div>
                        
                                <input type="range" id="js-roi-slider1" class="range roi-slider" step=".25" min=".5" max="5.5" value="2.5">
                        
                                <ul class="roi-slider-labels">
                                    <li>
                                    <a href="#" class="js-roi-label" data-value=".5">.5</a>
                                    </li>
                                </ul>
-->
                                </div>
                        </fieldset>
                        <fieldset class="roi-row">
                            <label class="roi-left">
                                <p class="roi-left__label">What is your hourly rate?</p>
                            </label>
                            <div class="roi-right">
                                <p>TEST If you manage more than 30 sites/month, you’re ready for your very own custom plan. Email <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="097a68656c7a496e6c7d6f65707e616c6c65276a6664">[email&#160;protected]</a> and we’ll generate a tailor-made ROI report and quote for you!</p>

<!-- ******************************** Slider
                                <div class="roi-thumb-contain">
                                    <span type="range" id="js-roi-thumb2" class="roi-thumb"></span>
                                </div>
                        
                                <input type="range" id="js-roi-slider2" class="range roi-slider" step="5" min="50" max="300" value="100">
                        
                                <ul class="roi-slider-labels">
                                    <li>
                                    <a href="#" class="js-roi-label" data-value="50">$50</a>
                                    </li>
                                </ul>
-->
                            </div>
                        </fieldset>
                    
                        <fieldset class="roi-row">
                            <label class="roi-left">
                                <p class="roi-left__label">Tell us where to send your results.</p>
                            </label>
                            <div class="roi-right">
                                <input class="roi-pdf-form__input" name="firstname" placeholder="First name">
                                <input class="roi-pdf-form__input" name="lastname" placeholder="Last name">
                                <input class="roi-pdf-form__input" name="email" placeholder="Work email">
                                <input class="roi-pdf-form__input" name="phone" placeholder="Phone number">
                            </div>
                        </fieldset>
                        <fieldset class="roi-row content-center">
                            <button type="submit" class="roi-button" id="roi-calculate-button">Calculate</button>
                        </fieldset>    
                    </form>
            </section> 
        </div>
    
    <!-- ************************************************* -->
    <?php
    }

    protected function _content_template() {
    //    <#
    //        view.addRenderAttribute(
    //            'roi_calculator_options',
    //            {
    //                'id': 'roi-calculator-id',
    //                'data-loop': settings.loop,
    //                'data-dots': settings.dots,
    //                'data-navs': settings.navs,
    //                'data-margin': settings.margin
    //            }
    //        );
    //    #>
    //    <# if( settings.slider.length ) { #>
    //    <div>
    //        <h1>hello _content_temlate()</h1>
    //    </div>
    //    <# } #>
        }

}
Plugin::instance()->widgets_manager->register_widget_type( new ROI_Calculator_Widget() );