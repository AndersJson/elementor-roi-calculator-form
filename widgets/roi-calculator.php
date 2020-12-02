<?php
namespace Elementor;
class ROI_Calculator_Widget extends Widget_Base {

    public function get_name() {
        return  'roi-calculator-id';
    }

    public function get_title() {
        return esc_html__( 'ROI Calculator Form', 'roi-elementor-widget' );
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
            'content_settings',
            [
                'label' => __( 'Content Settings', 'roi-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            // Checklist Repeater
            $repeater = new \Elementor\Repeater();
            $repeater->add_control(
                'checklist_text',
                [
                    'label' => __( 'Checklist Text', 'roi-elementor-widget' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( '' , 'roi-elementor-widget' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'checklist_icon',
                [
                    'label' => __( 'Checklist Icon', 'roi-elementor-widget' ),
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
                    'label' => __( 'Checklist', 'roi-elementor-widget' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'checklist_text' => __( 'Spending at least 3 hours/day maintaining sites', 'roi-elementor-widget' ),
                        ],
                        [
                            'checklist_text' => __( 'Its my fulltime job', 'roi-elementor-widget' ),
                        ],
                        [
                            'checklist_text' => __( 'Travelling more than 30 minutes to work', 'roi-elementor-widget' ),
                        ],
                        [
                            'checklist_text' => __( 'Have 5 or more employees', 'roi-elementor-widget' ),
                        ],
                    ],
                    'title_field' => '{{{ checklist_text }}}',
                ]
            );

        $this->end_controls_section();

        //Trigger styles control-function
        $this->style_tab();
    }

    private function style_tab() {
         // Image Style Settings
         $this->start_controls_section(
            'wrapper_style_section',
            [
                'label' => __( 'Wrapper', 'roi-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Padding
        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => __( 'Padding', 'roi-elementor-widget' ),
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
                'label' => __( 'Border', 'roi-elementor-widget' ),
                'selector' => '{{WRAPPER}} .roi-outer-wrapper',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label' => __( 'Border Radius', 'roi-elementor-widget' ),
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
                'label' => __( 'Box Shadow', 'roi-elementor-widget' ),
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
        ?>
        */
        foreach( $settings[ 'checklist' ] as $item ) : ?>
            <div><?php \Elementor\Icons_Manager::render_icon( $item['checklist_icon'], [ 'aria-hidden' => 'true' ] ); ?> <?php echo $item[ 'checklist_text' ]; ?></div>
        <?php endforeach; ?>

        <!-- *********************** -->
        <div class="roi-outer-wrapper">
            <section class="roi-inner-wrapper">
                    <form class="roi-calculation-form" id="roi-calculation-form">
                        <fieldset class="roi-row">
                            <label class="roi-left">
                                <br>How many sites do<br>you manage per month?
                                <span class="roi-tip-trigger">?</span>
                                <span class="roi-tip">
                                    <p>If you manage more than 30 sites/month, you’re ready for your very own custom plan. Email <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="097a68656c7a496e6c7d6f65707e616c6c65276a6664">[email&#160;protected]</a> and we’ll generate a tailor-made ROI report and quote for you!</p>
                                    <p>If you generate less than 5 sites a month, you can still select “5” to get a solid idea of what your ROI would be if your business grew a little bit more!</p>
                                </span>
                            </label>
                            <div class="roi-right">
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
                            <label class="roi-left">Which of the<br>following tasks do you<br>handle for your clients?</label>
                            <div class="roi-right">
                                <ul class="roi-checklist">
                                    <li>
                                    <label class="roi-checklist__label">
                                        <input type="checkbox" name="struggles[]" class="roi-checklist__mark" value="Dealing with downtime">
                                        <span>
                                        <!-- icon -->
                                        </span>
                                        Dealing with downtime
                                    </label>
                                    </li>
                                </ul>
                            </div>
                        </fieldset>
                    
                        <fieldset class="roi-row">
                            <label class="roi-left">
                                <br>How many hours (per month) do you spend managing all of the above tasks for just one of your sites?
                                <span class="roi-tip-trigger">?</span>
                                <span class="roi-tip">
                                    <p>Consider how much time it takes you or your team to deal with malware, downtime, WordPress updates, or slow site speeds. For each site, how much time do you spend on these issues? </p>
                                </span>
                            </label>
                            <div class="roi-right">
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
                            <label class="roi-left"><br>What is your hourly rate?</label>
                            <div class="roi-right">
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
                            <label class="roi-left">Tell us where to send your results.</label>
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