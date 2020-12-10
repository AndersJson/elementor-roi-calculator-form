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
        // Checklist Settings
        $this->start_controls_section(
            'checklist_settings',
            [
                'label' => __( 'Checklist Settings', 'roi-calculator-widget' ),
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
            'general_label_settings',
            [
                'label' => __( 'General Label Settings', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Label Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'general_label_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .label',
			]
        );

        // Tip-Trigger Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'first_tip_trigger_typography',
                'label' => __( 'Tip Trigger Font', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .roi-tip-trigger',
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
				'label' => __( 'Typography', 'roi-calculator-widget' ),
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
                'label' => __( 'Show First Label Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator' ),
                'label_off' => __( 'Hide', 'roi-calculator' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        // First Tip text
        $this->add_control(
            'first_tip_text',
            [
                'label' => __( 'First Tip Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Explanation and tip goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Type your tip here', 'roi-calculator-widget' ),
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
				'label' => __( 'First Tip Font', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .first-tip',
			]
        );

        
        $this->end_controls_section();

        // Submit-button Settings
        $this->start_controls_section(
            'submit_button_settings',
            [
                'label' => __( 'Submit-button Settings', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Submit-button Text
        $this->add_control(
            'submit_button_text',
            [
                'label' => __( 'Button Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Default', 'roi-calculator-widget' ),
                'label_block' => true,
                'placeholder' => __( 'Enter button-text here', 'roi-calculator-widget' ),
            ]
        );

        // Submit-button Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'submit_button_label_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #roi-submit-button',
			]
        );

        // Submit-button Link
        $this->add_control(
            'submit_button_link',
            [
                'label' => __( 'Button Link', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'roi-calculator-widget' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ]
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
                'tip_background_color',
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


        // Submit-button Style Settings
        $this->start_controls_section(
            'submit_button_style_section',
            [
                'label' => __( 'Submit-button', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        //Submit-button text-color
        $this->add_control(
            'submit_button_text_color',
            [
                'label' => __( 'Button Text Color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2AAECD',
                'description' => 'Default: ( #2AAECD ) ',
                'selectors' => [
                    '{{WRAPPER}} #roi-submit-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Submit Padding
        $this->add_responsive_control(
            'submit_button_padding',
            [
                'label' => __( 'Button Padding', 'roi-calculator-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'rem', '%', 'px' ],
                'description' => 'Default: ( 1rem 2rem 1rem 2rem )',
                'default' => [
                    'top' => 1,
                    'right' => 2,
                    'bottom' => 1,
                    'left' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} #roi-submit-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'submit_button_border_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        // Submit-button Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submit-button_border',
                'label' => __( 'Button Border', 'roi-calculator-widget' ),
                'selector' => '{{WRAPPER}} #roi-submit-button',
            ]
        );

         // Submit-button Border Radius
         $this->add_responsive_control(
            'submit_button_border_radius',
            [
                'label' => __( 'Button Border Radius', 'roi-calculator-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'rem', '%', 'px' ],
                'description' => 'Default: ( 3rem 3rem 3rem 3rem )',
                'default' => [
                    'top' => 3,
                    'right' => 3,
                    'bottom' => 3,
                    'left' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} #roi-submit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

                ],
            ]
        );

        $this->add_control(
            'submit_button_shadow_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        // Submit-button Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submit_button_box_shadow',
                'label' => __( 'Button Box Shadow', 'roi-calculator-widget' ),
                'selector' => '{{WRAPPER}} #roi-submit-button',
            ]
        );

        // Submit-button Background Color
        $this->add_control(
            'submit_button_background_color',
            [
                'label' => __( 'Button Background Color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'description' => 'Default: ( #FFFFFF ) ',
                'selectors' => [
                    '{{WRAPPER}} #roi-submit-button ' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        // Button
        $button_target = $settings[ 'submit_button_link' ][ 'is_external' ] ? ' target="_blank"' : '';
        $button_nofollow = $settings[ 'submit_button_link' ][ 'nofollow' ] ? ' rel="nofollow"' : '';
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
                        <fieldset class="roi-row flex-row-space-between">
                            <label class="roi-left">
                            <p class="roi-left__label"><?php echo $settings[ 'first_label_text' ]; ?></p>
                            <?php if( $settings[ 'show_first_label_tip' ] == 'yes') : ?>
                                <span class="roi-tip-trigger flex-center"><p>?</p></span>
                                <span class="roi-tip">
                                    <p><?php echo $settings[ 'first_tip_text' ]; ?></p>
                                </span>
                            <?php endif; ?>
                            </label>
                            <div class="roi-right">
                                <div class="range__value" id="rangeV"></div>
                                <input id="range__input" type="range" min="0" max="10" step="1">
                            </div>
                        </fieldset>
                    
                        <fieldset class="roi-row flex-row-space-between">
                            <label class="roi-left">
                                <p class="roi-left__label">Which of the following tasks do you handle for your clients?</p>
                            </label>
                            <div class="roi-right">
                                <ul class="roi-checklist">
                                <?php
                                foreach( $settings[ 'checklist' ] as $item ) : ?>
                                    <label class="roi-checklist__label">
                                        <li>
                                            <input type="checkbox" name="struggles[]" class="roi-checklist__checkbox" value="<?php echo $item[ 'checklist_text' ]; ?>">
                                            <span class="roi-checklist__icon flex-center">
                                                <?php \Elementor\Icons_Manager::render_icon( $item['checklist_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </span>
                                            <?php echo $item[ 'checklist_text' ]; ?>
                                        </li>
                                    </label>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </fieldset>
                        <fieldset class="roi-row flex-row-space-between">
                            <label class="roi-left">
                                <p class="roi-left__label">How many hours (per month) do you spend managing all of the above tasks for just one of your sites?</p>
                                <span class="roi-tip-trigger flex-center"><p>?</p></span>
                                <span class="roi-tip">
                                    <p>Consider how much time it takes you or your team to deal with malware, downtime, WordPress updates, or slow site speeds. For each site, how much time do you spend on these issues? </p>
                                </span>
                            </label>
                            <div class="roi-right range">
                                    <div class="range__value" id="rangeV"></div>
                                    <input id="range__input" type="range" min="0" max="10" step="1">
 
                        <!--
                                <ul class="roi-slider-labels">
                                    <li>
                                    <a href="#" class="js-roi-label" data-value=".5">.5</a>
                                    </li>
                                </ul>
-->
                            </div>
                        </fieldset>
                        <fieldset class="roi-row flex-row-space-between">
                            <label class="roi-left">
                                <p class="roi-left__label">What is your hourly rate?</p>
                            </label>
                            <div class="roi-right">
                                <div class="range__value" id="rangeV"></div>
                                <input id="range__input" type="range" min="0" max="10" step="1">
                            </div>
                        </fieldset>
                    
                        <fieldset class="roi-row flex-row-space-between">
                            <label class="roi-left">
                                <p class="roi-left__label">Tell us where to send your results.</p>
                            </label>
                            <div class="roi-right">
                                <input class="roi-form__textinput" name="firstname" placeholder="First name">
                                <input class="roi-form__textinput" name="lastname" placeholder="Last name">
                                <input class="roi-form__textinput" name="email" placeholder="Work email">
                                <input class="roi-form__textinput" name="phone" placeholder="Phone number">
                            </div>
                        </fieldset>
                        <fieldset class="roi-row flex-center">
                            <button type="submit" class="roi-button roi-button--primary" id="roi-submit-button"><?php echo $settings[ 'submit_button_text' ] ?></button>
                        </fieldset>    
                    </form>
            </section> 
        </div>
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