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
        // Typography Settings
        $this->start_controls_section(
            'typography_settings',
            [
                'label' => __( 'Typography', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'more_options_general typography',
            [
                'label' => __( 'Default Typography', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // General Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'general_typography',
				'label' => __( 'General Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .roi-row',
			]
        );

        // Label Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'general_label_typography',
				'label' => __( 'Label Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .roi-left__label',
			]
        );

        // Tip-Trigger Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tip_trigger_typography',
                'label' => __( 'Tip Trigger Font', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .roi-tip-trigger',
            ]
        );

        // Tip Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tip_typography',
				'label' => __( 'Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .roi-tip',
			]
        );

        $this->end_controls_section();


        //Labels
        $this->start_controls_section(
            'label_settings',
            [
                'label' => __( 'Labels', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Lable-Tabs
        $this->start_controls_tabs(
            'label_tabs'
        );

        //Checklist-Label
        $this->start_controls_tab(
            'checklist_slider_label_tab',
            [
                'label' => __( 'Checklist', 'roi-calculator-widget' ),
            ]
        );

        // Checkist Label Text
        $this->add_control(
            'checklist_label_text',
            [
                'label' => __( 'Label text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Label text', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for label', 'roi-calculator-widget' ),
            ]
        );

        // Checklist Label Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'checklist_label_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .checklist-label',
			]
        );
        
        $this->add_control(
            'more_options_checklis_label_tip',
            [
                'label' => __( 'Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Checklist Label Tip
        $this->add_control(
            'show_checklist_label_tip',
            [
                'label' => __( 'Show Label Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator' ),
                'label_off' => __( 'Hide', 'roi-calculator' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        // Checklist Tip text
        $this->add_control(
            'checklist_tip_text',
            [
                'label' => __( 'Tip Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Explanation and tip goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Type your tip here', 'roi-calculator-widget' ),
                'condition' => [
                    'show_checklist_label_tip' => 'yes'
                ]
            ]
        );

        // Checklist Tip Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'checklist_tip_typography',
				'label' => __( 'Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .checklist-tip',
			]
        );

        $this->end_controls_tab();

        //Money-Range
        $this->start_controls_tab(
            'money_range_label_tab',
            [
                'label' => __( 'Money-Range', 'roi-calculator-widget' ),
            ]
        );

        // Money-Range Text
        $this->add_control(
            'money_range_label_text',
            [
                'label' => __( 'Label text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Label text', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for label', 'roi-calculator-widget' ),
            ]
        );

        // Money-Range Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'money_range_label_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .money-range-label',
			]
        );
        
        $this->add_control(
            'more_options_money_range_label_tip',
            [
                'label' => __( 'Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Money-Range Tip
        $this->add_control(
            'show_money_range_label_tip',
            [
                'label' => __( 'Show Label Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator' ),
                'label_off' => __( 'Hide', 'roi-calculator' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        // Money-Range Tip text
        $this->add_control(
            'money_range_tip_text',
            [
                'label' => __( 'Tip Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Explanation and tip goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Type your tip here', 'roi-calculator-widget' ),
                'condition' => [
                    'show_money_range_label_tip' => 'yes'
                ]
            ]
        );

        // Money-Range Tip Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'money_range_tip_typography',
				'label' => __( 'Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .money-range-tip',
			]
        );

        $this->end_controls_tab();

        //Form-Label
        $this->start_controls_tab(
            'form_label_tab',
            [
                'label' => __( 'Contact Form', 'roi-calculator-widget' ),
            ]
        );

        // Form-Label Text
        $this->add_control(
            'form_label_text',
            [
                'label' => __( 'Label text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Label text', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for label', 'roi-calculator-widget' ),
            ]
        );

        // Form-Label Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'form_label_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .form-label',
			]
        );
        
        $this->add_control(
            'more_options_form_label_tip',
            [
                'label' => __( 'Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Form-Label Tip
        $this->add_control(
            'show_form_label_tip',
            [
                'label' => __( 'Show Label Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator' ),
                'label_off' => __( 'Hide', 'roi-calculator' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        // Form-Tip text
        $this->add_control(
            'form_tip_text',
            [
                'label' => __( 'Tip Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Explanation and tip goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Type your tip here', 'roi-calculator-widget' ),
                'condition' => [
                    'show_form_label_tip' => 'yes'
                ]
            ]
        );

        // Form-Tip Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'form_tip_typography',
				'label' => __( 'Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .form-tip',
			]
        );

        $this->end_controls_tab();


        $this->end_controls_tabs();
        $this->end_controls_section();

        // Checklist Settings
        $this->start_controls_section(
            'checklist_settings',
            [
                'label' => __( 'Checklist', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Lable-Tabs
        $this->start_controls_tabs(
            'checklist_tabs'
        );

        //Checklist-tab
        $this->start_controls_tab(
            'checklist_list_tab',
            [
                'label' => __( 'Checklist', 'roi-calculator-widget' ),
            ]
        );

        // Checklist Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'checklist_text_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .roi-checklist__labeltext',
			]
        );


        // Checklist Typography(Icon Size)
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'checklist_icon_typography',
				'label' => __( 'Icon Size', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .roi-checklist__icon',
			]
        );

            $this->add_control(
                'more_options_checklist_items',
                [
                    'label' => __( 'Checklist items and icons', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before'
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

            // Checklist Save Percent
            $repeater->add_control(
                'checklist_save_percent',
                [
                    'label' => __( 'Save-percent', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'default' => 0,
                ]
            );

            $repeater->add_control(
                'more_options_checklist_amount_range',
                [
                    'label' => __( 'Amount range-input', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            // Checklist Amount-Range Heading
            $repeater->add_control(
                'checklist_amount_range_header_text',
                [
                    'label' => __( 'Amount-range Heading', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Heading for Amount-range', 'roi-calculator-widget' ),
                    'label_block' => true,
                    'placeholder' => __( 'Header for amount-range', 'roi-calculator-widget' ),
                ]
            );

            // Checklist Amount-Range Min
            $repeater->add_control(
                'checklist_amount_range_min',
                [
                    'label' => __( 'Min-value', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 1000000000,
                    'step' => 1,
                    'default' => 0,
                ]
            );

            // Checklist Amount-Range Max
            $repeater->add_control(
                'checklist_amount_range_max',
                [
                    'label' => __( 'Max-value', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 1000000000,
                    'step' => 1,
                    'default' => 10,
                ]
            );

            // Checklist Amount-Range Step
            $repeater->add_control(
                'checklist_amount_range_step',
                [
                    'label' => __( 'Step', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 1000000000,
                    'step' => 1,
                    'default' => 1,
                ]
            );
            
            //Checklist Amount-Range Fillcolor
            $repeater->add_control(
                'checklist_amount_range_color',
                [
                    'label' => __( 'Track Fill-Color', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'default' => '#2AAECD',
                    'description' => 'Default: ( #2AAECD ) ',
                ]
            );

            // Checklist Amount-Range labels
            $repeater->add_control(
                'show_checklist_amount_range_labels',
                [
                    'label' => __( 'Show Labels', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'roi-calculator-widget' ),
                    'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            // Checklist Amount-Range max-suffix
            $repeater->add_control(
                'show_checklist_amount_range_max_suffix',
                [
                    'label' => __( 'Show Max-Suffix: + ', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'roi-calculator-widget' ),
                    'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_checklist_amount_range_labels' => 'yes'
                    ]
                ]
            ); 

            // Checklist Amount-Range dollar-prefix
            $repeater->add_control(
                'show_checklist_amount_range_dollar_prefix',
                [
                    'label' => __( 'Show Prefixes: $ ', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'roi-calculator-widget' ),
                    'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $repeater->add_control(
                'more_options_checklist_time_range',
                [
                    'label' => __( 'Time range-input', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            // Checklist Time-Range Heading
            $repeater->add_control(
                'checklist_time_range_header_text',
                [
                    'label' => __( 'Time-range Heading', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Heading for Time-range', 'roi-calculator-widget' ),
                    'label_block' => true,
                    'placeholder' => __( 'Header for Time-range', 'roi-calculator-widget' ),
                ]
            );

            // Checklist Time-Range Min
            $repeater->add_control(
                'checklist_time_range_min',
                [
                    'label' => __( 'Min-value', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 1000000000,
                    'step' => 1,
                    'default' => 0,
                ]
            );

            // Checklist Time-Range Max
            $repeater->add_control(
                'checklist_time_range_max',
                [
                    'label' => __( 'Max-value', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 1000000000,
                    'step' => 1,
                    'default' => 10,
                ]
            );

            // Checklist Time-Range Step
            $repeater->add_control(
                'checklist_time_range_step',
                [
                    'label' => __( 'Step', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 1000000000,
                    'step' => 1,
                    'default' => 1,
                ]
            );
            
            //Checklist Time-Range Fillcolor
            $repeater->add_control(
                'checklist_time_range_color',
                [
                    'label' => __( 'Track Fill-Color', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'default' => '#2AAECD',
                    'description' => 'Default: ( #2AAECD ) ',
                ]
            );

            // Checklist Time-Range labels
            $repeater->add_control(
                'show_checklist_time_range_labels',
                [
                    'label' => __( 'Show Labels', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'roi-calculator-widget' ),
                    'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            // Checklist Time-Range max-suffix
            $repeater->add_control(
                'show_checklist_time_range_max_suffix',
                [
                    'label' => __( 'Show Max-Suffix: + ', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'roi-calculator-widget' ),
                    'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_checklist_time_range_labels' => 'yes'
                    ]
                ]
            ); 

            // Checklist Time-Range dollar-prefix
            $repeater->add_control(
                'show_checklist_time_range_dollar_prefix',
                [
                    'label' => __( 'Show Prefixes: $ ', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'roi-calculator-widget' ),
                    'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                    'return_value' => 'yes',
                    'default' => 'no',
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
                            'checklist_text' => __( 'Spending at least 3 hours/month placing orders for computers', 'roi-calculator-widget' ),
                        ],
                    ],
                    'title_field' => '{{{ checklist_text }}}',
                ]
            );

            $this->end_controls_tab();

            //Checklist ranges-tab
            $this->start_controls_tab(
                'checklist_range_tab',
                [
                    'label' => __( 'Ranges', 'roi-calculator-widget' ),
                ]
            );

              // Checklist-Range Heading Typography
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'checklist_range_header',
                    'label' => __( 'Heading', 'roi-calculator-widget' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .range__header',
                ]
            );

            // Checklist-Range Value Typography
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'checklist_range_value_typography',
                    'label' => __( 'Value-Bubble', 'roi-calculator-widget' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .checklist-range-value span',
                ]
            );

            // Checklist-Range Labellist Typography
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'checklist_range_labellist_typography',
                    'label' => __( 'Labels', 'roi-calculator-widget' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .checklist-range-labellist li',
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        //Money-Range Settings
        $this->start_controls_section(
            'money_range_settings',
            [
                'label' => __( 'Money-Range', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Money-Range Min
        $this->add_control(
			'money_range_min',
			[
				'label' => __( 'Min-value', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1000000000,
				'step' => 1,
				'default' => 0,
			]
        );
        
        // Money-Range Max
        $this->add_control(
			'money_range_max',
			[
				'label' => __( 'Max-value', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000000000,
				'step' => 1,
				'default' => 10,
			]
        );

        // Money-Range Step
        $this->add_control(
			'money_range_step',
			[
				'label' => __( 'Step', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000000000,
				'step' => 1,
				'default' => 1,
			]
        );
        
        //Money-Range Fillcolor
        $this->add_control(
			'money_range_color',
			[
				'label' => __( 'Track Fill-Color', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#2AAECD',
                'description' => 'Default: ( #2AAECD ) ',
			]
        );

        // Money-Range labels
        $this->add_control(
            'show_money_range_labels',
            [
                'label' => __( 'Show Labels', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator-widget' ),
                'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        // Money-Range max-suffix
        $this->add_control(
            'show_money_range_max_suffix',
            [
                'label' => __( 'Show Max-Suffix: + ', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator-widget' ),
                'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_money_range_labels' => 'yes'
                ]
            ]
        ); 

        // Money-Range dollar-prefix
        $this->add_control(
            'show_money_range_dollar_prefix',
            [
                'label' => __( 'Show Prefixes: $ ', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator-widget' ),
                'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'more_options_money_range_text',
            [
                'label' => __( 'Typography', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Money-Range Value Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'money_range_value_typography',
				'label' => __( 'Value-Bubble', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .money-range-value span',
			]
        );

        // Money-Range Labellist Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'money_range_labellist_typography',
				'label' => __( 'Labels', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .money-range-labellist li',
			]
        );

        $this->end_controls_section();

        //Form Settings
        $this->start_controls_section(
            'form_settings',
            [
                'label' => __( 'Contact Form', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Form Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'form_input_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .roi-form__textinput',
			]
        );

        // Firstname Placeholder Text
        $this->add_control(
            'firstname_placeholder_text',
            [
                'label' => __( 'Firstname Placeholder', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Firstname', 'roi-calculator-widget' ),
                'label_block' => true,
                'placeholder' => __( 'Enter placeholder-text here', 'roi-calculator-widget' ),
            ]
        );

        // Lastname Placeholder Text
        $this->add_control(
            'lastname_placeholder_text',
            [
                'label' => __( 'Lastname Placeholder', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Lastname', 'roi-calculator-widget' ),
                'label_block' => true,
                'placeholder' => __( 'Enter placeholder-text here', 'roi-calculator-widget' ),
            ]
        );

        // Lastname Placeholder Text
        $this->add_control(
            'email_placeholder_text',
            [
                'label' => __( 'Lastname Placeholder', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Email', 'roi-calculator-widget' ),
                'label_block' => true,
                'placeholder' => __( 'Enter placeholder-text here', 'roi-calculator-widget' ),
            ]
        );

        // Phone Placeholder Text
        $this->add_control(
            'phone_placeholder_text',
            [
                'label' => __( 'Phone Placeholder', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Phone', 'roi-calculator-widget' ),
                'label_block' => true,
                'placeholder' => __( 'Enter placeholder-text here', 'roi-calculator-widget' ),
            ]
        );

        $this->end_controls_section();

        // Submit-button Settings
        $this->start_controls_section(
            'submit_button_settings',
            [
                'label' => __( 'Submit-button', 'roi-calculator-widget' ),
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

        $this->end_controls_section();


        //Trigger styles control-function
        $this->style_tab();
    }

    private function style_tab() {
        // General Style Settings
        $this->start_controls_section(
            'general_style_section',
            [
                'label' => __( 'General styling', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'more_options_row',
            [
                'label' => __( 'Row', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Row Margin
        $this->add_responsive_control(
            'row_margin',
            [
                'label' => __( 'Row Margin', 'roi-calculator-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'description' => 'Default: ( 0px 0px 30px 0px )',
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 30,
                    'left' => 0,
                    'isLinked' => 'false'
                ],
                'selectors' => [
                    '{{WRAPPER}} .roi-row' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

            $this->add_control(
                'more_options_label_text',
                [
                    'label' => __( 'Label text', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            // Text Color
            $this->add_control(
                'label_text_color',
                [
                    'label' => __( 'Text Color', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#54595f',
                    'description' => 'Default: ( #54595f ) ',
                    'selectors' => [
                        '{{WRAPPER}} .roi-left__label' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'more_options_tip_icon',
                [
                    'label' => __( 'Tip Icon', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            // Tip-Icon Color
            $this->add_control(
                'tip_icon_color',
                [
                    'label' => __( 'Tip-Icon Color', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#54595f',
                    'description' => 'Default: ( #54595f ) ',
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip-trigger p' => 'color: {{VALUE}};'
                    ],
                ]
            );

            //Tip-Icon Border
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'tip_icon_border',
                    'label' => __( 'Checklist Icon Border', 'roi-calculator-widget' ),
                    'selector' => '{{WRAPPER}} .roi-tip-trigger',
                ]
            );

            // Tip-Icon Size
            $this->add_responsive_control(
                'tip-icon_size',
                [
                    'label' => __( 'Tip-Icon Size', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem' ],
                    'description' => 'Default: ( 30px )',
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        'rem' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                ]
            );

            // Tip-Icon Position Right
            $this->add_responsive_control(
                'tip-icon_position_right',
                [
                    'label' => __( 'Tip-Icon Position Right', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'rem', 'em', '%' ],
                    'description' => 'Default: ( 20px )',
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        'rem' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip-trigger' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // Tip-Icon Position Top
            $this->add_responsive_control(
                'tip-icon_position_top',
                [
                    'label' => __( 'Tip-Icon Position Top', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'rem', 'em', '%' ],
                    'description' => 'Default: ( 0px )',
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        'rem' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip-trigger' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'more_options_tip_text',
                [
                    'label' => __( 'Tip Popup', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            //Tip text-color
            $this->add_control(
                'tip_text_color',
                [
                    'label' => __( 'Tip Text Color', 'roi-calculator-widget' ),
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
                    'description' => 'Default: ( 0px 0px 0px 0px )',
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
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
                    'description' => 'Default: ( 0px 0px 0px 0px )',
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
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

        // Checklist Style Settings
        $this->start_controls_section(
            'checklist_style_section',
            [
                'label' => __( 'Checklist', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'checklist_style_tabs'
        );

        //Checklist-icon tab
        $this->start_controls_tab(
            'checklist_style_tab',
            [
                'label' => __( 'Icon', 'roi-calculator-widget' ),
            ]
        );

        // Checklist Icon Un-Checked Color
        $this->add_control(
            'checklist_unchecked_color',
            [
                'label' => __( 'Checklist-Icon Inactive Color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e7e7e7',
                'description' => 'Default: ( #e7e7e7 ) ',
                'selectors' => [
                    '{{WRAPPER}} .roi-checklist__icon ' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Checklist Icon Checked Color
        $this->add_control(
            'checklist_checked_color',
            [
                'label' => __( 'Checklist-Icon Active Color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2AAECD',
                'description' => 'Default: ( #2AAECD ) ',
                'selectors' => [
                    '{{WRAPPER}} .roi-checklist__checkbox:checked + .roi-checklist__icon ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'checklist_border_before_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        // Checklist-Icon Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'checklist_icon_border',
                'label' => __( 'Checklist Icon Border', 'roi-calculator-widget' ),
                'selector' => '{{WRAPPER}} .roi-checklist__icon',
            ]
        );

        $this->add_control(
            'checklist_border_after_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        

        // Checklist-Icon Size
        $this->add_responsive_control(
            'checklist-icon_size',
            [
                'label' => __( 'Checklist-Icon Size', 'roi-calculator-widget' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'description' => 'Default: ( 35px )',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 35,
                ],
            ]
        );

        // Checklist-Icon Margin
        $this->add_responsive_control(
            'checklist_icon_margin',
            [
                'label' => __( 'Margin', 'roi-calculator-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem' ],
                'description' => 'Default: ( 0px 16px 0px 0px )',
                'default' => [
                    'top' => 7,
                    'right' => 16,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => 'false'
                ],
                'selectors' => [
                    '{{WRAPPER}} .roi-checklist__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        //Checklist-range tab
        $this->start_controls_tab(
            'checklist__range_style_tab',
            [
                'label' => __( 'Range', 'roi-calculator-widget' ),
            ]
        );


        // Checklist-Range Value Border-color
        $this->add_control(
            'checklist_range_value_border_color',
            [
                'label' => __( 'Value-Bubble border-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2AAECD',
                'description' => 'Default: ( #2AAECD ) ',
                'selectors' => [
                    '{{WRAPPER}} .checklist-range-value span ' => 'border: 2px solid {{VALUE}}',
                    '{{WRAPPER}} .checklist-range-value span:before ' => 'border-top: 18px solid {{VALUE}}',
                ],
            ]
        );

        // Checklist-Range Value Border-color
        $this->add_control(
            'checklist_range_value_text_color',
            [
                'label' => __( 'Value-Bubble text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'description' => 'Default: ( #000000 ) ',
                'selectors' => [
                    '{{WRAPPER}} .checklist-range-value span ' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Checklist-Range Value Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'checklist_range_value_shadow',
                'label' => __( 'Value-Bubble shadow', 'roi-calculator-widget' ),
                'selector' => '{{WRAPPER}} .checklist-range-value span',
            ]
        );

        // Checklist-Range Thumb-color
        $this->add_control(
            'checklist_range_thumb_color',
            [
                'label' => __( 'Handle-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFF',
                'description' => 'Default: ( #FFF ) ',
                'selectors' => [
                    '{{WRAPPER}} .checklist-range-wrapper input[type="range"]::-webkit-slider-thumb ' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .checklist-range-wrapper input[type="range"]::-moz-range-thumb ' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .checklist-range-wrapper input[type="range"]::-ms-thumb ' => 'background: {{VALUE}}',
                ],
            ]
        );

        // Checklist-Range Labellist text-color
        $this->add_control(
            'checklist_range_labellist_text_color',
            [
                'label' => __( 'Labels text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'description' => 'Default: ( #000000 ) ',
                'selectors' => [
                    '{{WRAPPER}} .checklist-range-labellist ' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tabs();

        $this->end_controls_section();

        // Money-Range Style Settings
        $this->start_controls_section(
            'money_range_style_section',
            [
                'label' => __( 'Money-Range', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Money-Range Value Border-color
        $this->add_control(
            'money_range_value_border_color',
            [
                'label' => __( 'Value-Bubble border-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2AAECD',
                'description' => 'Default: ( #2AAECD ) ',
                'selectors' => [
                    '{{WRAPPER}} .money-range-value span ' => 'border: 2px solid {{VALUE}}',
                    '{{WRAPPER}} .money-range-value span:before ' => 'border-top: 18px solid {{VALUE}}',
                ],
            ]
        );

        // Money-Range Value Border-color
        $this->add_control(
            'money_range_value_text_color',
            [
                'label' => __( 'Value-Bubble text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'description' => 'Default: ( #000000 ) ',
                'selectors' => [
                    '{{WRAPPER}} .money-range-value span ' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Money-Range Value Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'money_range_value_shadow',
                'label' => __( 'Value-Bubble shadow', 'roi-calculator-widget' ),
                'selector' => '{{WRAPPER}} .money-range-value span',
            ]
        );

        // Money-Range Thumb-color
        $this->add_control(
            'money_range_thumb_color',
            [
                'label' => __( 'Handle-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFF',
                'description' => 'Default: ( #FFF ) ',
                'selectors' => [
                    '{{WRAPPER}} .money-range-wrapper input[type="range"]::-webkit-slider-thumb ' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .money-range-wrapper input[type="range"]::-moz-range-thumb ' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .money-range-wrapper input[type="range"]::-ms-thumb ' => 'background: {{VALUE}}',
                ],
            ]
        );

        // Money-Range Labellist text-color
        $this->add_control(
            'money_range_labellist_text_color',
            [
                'label' => __( 'Labels text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'description' => 'Default: ( #000000 ) ',
                'selectors' => [
                    '{{WRAPPER}} .money-range-labellist ' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_section();


        // Form Style Settings
        $this->start_controls_section(
            'form_style_section',
            [
                'label' => __( 'Contact Form', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Form Input Width
        $this->add_responsive_control(
            'form_input_width',
            [
                'label' => __( 'Input Width', 'roi-calculator-widget' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem' ],
                'description' => 'Default: ( 46% )',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .roi-form__textinput' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Form Input Border Radius
        $this->add_responsive_control(
            'form_input_border_radius',
            [
                'label' => __( 'Border Radius', 'roi-calculator-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'rem', '%', 'px' ],
                'description' => 'Default: ( 2px 2px 2px 2px )',
                'default' => [
                    'top' => [
                        'unit' => 'px',
                        'size' => 2
                    ],
                    'right' => [
                        'unit' => 'px',
                        'size' => 2
                    ],
                    'bottom' => [
                        'unit' => 'px',
                        'size' => 2
                    ],
                    'left' => [
                        'unit' => 'px',
                        'size' => 2
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .roi-form__textinput' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

                ],
            ]
        );

        // Form Inputs Margin
        $this->add_responsive_control(
            'form_input_margin',
            [
                'label' => __( 'Margin', 'roi-calculator-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem' ],
                'description' => 'Default: ( 0px 20px 20px 0px )',
                'default' => [
                    'top' => 7,
                    'right' => 16,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => 'false'
                ],
                'selectors' => [
                    '{{WRAPPER}} .roi-form__textinput' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Form Input Padding
        $this->add_responsive_control(
            'form_input_padding',
            [
                'label' => __( 'Padding', 'roi-calculator-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'rem', '%', 'px', 'em' ],
                'description' => 'Default: ( 1em 1em 1em 1em )',
                'default' => [
                    'top' => [
                        'unit' => 'em',
                        'size' => 1
                    ],
                    'right' => [
                        'unit' => 'em',
                        'size' => 1
                    ],
                    'bottom' => [
                        'unit' => 'em',
                        'size' => 1
                    ],
                    'left' => [
                        'unit' => 'em',
                        'size' => 1
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .roi-form__textinput' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'more_options_form_input_box_shadow',
            [
                'label' => __( 'Box-Shadow : inset 0 0 0 1px #c7c4c4', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Form Input Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'form_input_box_shadow',
                'label' => __( 'Input Box Shadow', 'roi-calculator-widget' ),
                'selector' => '{{WRAPPER}} .roi-form__textinput',
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

        $this->add_control(
            'more_options_submit_button_base',
            [
                'label' => __( 'Basic Styles', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
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
                    'top' => [
                        'unit' => 'rem',
                        'size' => 1
                    ],
                    'right' => [
                        'unit' => 'rem',
                        'size' => 2
                    ],
                    'bottom' => [
                        'unit' => 'rem',
                        'size' => 1
                    ],
                    'left' => [
                        'unit' => 'rem',
                        'size' => 1
                    ],
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
                    'top' => [
                        'unit' => 'rem',
                        'size' => 3
                    ],
                    'right' => [
                        'unit' => 'rem',
                        'size' => 3
                    ],
                    'bottom' => [
                        'unit' => 'rem',
                        'size' => 3
                    ],
                    'left' => [
                        'unit' => 'rem',
                        'size' => 3
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #roi-submit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

                ],
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

            $this->add_control(
                'more_options_submit_button_hover',
                [
                    'label' => __( 'Default/Hover Styles', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            // Submit-Button Tabs
            $this->start_controls_tabs(
                'submit_button_style_tabs'
            );

            /* ********** NORMAL STATE BEGIN ************* */

            $this->start_controls_tab(
                'submit_button_normal_state',
                [
                    'label' => __( 'Default Style', 'roi-calculator-widget' ),
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

            $this->end_controls_tab();
            /* ********** NORMAL STATE END ************* */

            /* ********** HOVER STATE BEGIN ************* */

            $this->start_controls_tab(
                'submit_button_hover_state',
                [
                    'label' => __( 'Hover-Style', 'roi-calculator-widget' ),
                ]
            );
                // Background Color
                $this->add_control(
                    'submit_button_hover_bg_color',
                    [
                        'label' => __( 'Background Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#2AAECD',
                        'description' => 'Default: ( #2AAECD ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-submit-button:hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                // Text Color
                $this->add_control(
                    'submit_button_hover_text_color',
                    [
                        'label' => __( 'Text Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#FFFFFF',
                        'description' => 'Default: ( #FFFFFF ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-submit-button:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab();
            /* ********** HOVER STATE END ************* */
            
            $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        // Button
        //$button_target = $settings[ 'submit_button_link' ][ 'is_external' ] ? ' target="_blank"' : '';
        //$button_nofollow = $settings[ 'submit_button_link' ][ 'nofollow' ] ? ' rel="nofollow"' : '';
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
                            <p class="roi-left__label checklist-label"><?php echo $settings[ 'checklist_label_text' ]; ?></p>
                            <?php if( $settings[ 'show_checklist_label_tip' ] == 'yes') : ?>
                                <span class="roi-tip-trigger flex-center" style="height: <?php echo $settings[ 'tip-icon_size' ]['size']?><?php echo $settings[ 'tip-icon_size' ]['unit'] ?>; width: <?php echo $settings[ 'tip-icon_size' ]['size']?><?php echo $settings[ 'tip-icon_size' ]['unit'] ?>;"><p>?</p></span>
                                <span class="roi-tip checklist-tip">
                                    <p><?php echo $settings[ 'checklist_tip_text' ]; ?></p>
                                </span>
                            <?php endif; ?>
                            </label>
                            <div class="roi-right">
                                <ul class="roi-checklist">
                                <?php
                                $checklist_count = 1;
                                foreach( $settings[ 'checklist' ] as $item ) : ?>
                                    <label class="roi-checklist__label" id="checklist-item_<?php echo $checklist_count ?>">
                                        <li class="roi-checklist__item">
                                            <input type="checkbox" name="struggles[]" id="checklist-checkbox_<?php echo $checklist_count ?>" class="roi-checklist__checkbox" value="<?php echo $item[ 'checklist_text' ]; ?>" data-save="<?php echo $item[ 'checklist_save_percent' ] ?>">
                                            <span class="roi-checklist__icon flex-center" style="height: <?php echo $settings[ 'checklist-icon_size' ]['size']?><?php echo $settings[ 'checklist-icon_size' ]['unit'] ?>; width: <?php echo $settings[ 'checklist-icon_size' ]['size']?><?php echo $settings[ 'checklist-icon_size' ]['unit'] ?>;">
                                                <?php \Elementor\Icons_Manager::render_icon( $item['checklist_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </span>
                                            <span class="roi-checklist__labeltext">
                                                <?php echo $item[ 'checklist_text' ]; ?>
                                            </span>
                                        </li>
                                    </label>
                                    <div class="checklist-rangewrapper hidden">
                                        <div class="flex flex-column-end mb-medium">
                                            <div class="range__header mb-medium w-80" id="amountheader_<?php echo $checklist_count ?>"><p><?php echo $item[ 'checklist_amount_range_header_text' ] ?></p></div>
                                            <div class="range__wrapper checklist-range-wrapper w-80 mb-small" id="checklist-amountrange_<?php echo $checklist_count ?>">
                                                <div class="range__value checklist-range-value" id="amountvalue_<?php echo $checklist_count ?>"></div>
                                                <input class="checklist-range__input" id="amountinput_<?php echo $checklist_count ?>" type="range" min="<?php echo $item[ 'checklist_amount_range_min' ]; ?>" max="<?php echo $item[ 'checklist_amount_range_max' ]; ?>" step="<?php echo $item[ 'checklist_amount_range_step' ]; ?>" data-fill="<?php echo $item[ 'checklist_amount_range_color' ]; ?>">
                                                <?php if( $item[ 'show_checklist_amount_range_labels' ] == 'yes' ) : ?>
                                                <ul id="amountlabellist_<?php echo $checklist_count ?>" class="checklist-range-labellist mb-small">
                                                <?php
                                                    //Dynamic cheklist amount-range labels
                                                    $amountmin = (float)$item [ 'checklist_amount_range_min' ];
                                                    $amountmax = (float)$item [ 'checklist_amount_range_max' ];
                                                    $amountinterval = ($amountmax - $amountmin) / 5;
                                                    $amountnextstep = $amountmin;
                                                    $amountvalue = $amountmin;

                                                    for ($y = 0; $y < 6; $y++){
                                                        if ($y == 5){ 
                                                            echo '<li class="range__label">' . ($item[ 'show_checklist_amount_range_dollar_prefix' ] == 'yes' ?  '&#36;' : '') . $amountvalue . ($item[ 'show_checklist_amount_range_max_suffix' ] == 'yes' ? '&#43;' : '') .'</li>';       
                                                        }
                                                        else{
                                                            echo '<li class="range__label">' . ($item[ 'show_checklist_amount_range_dollar_prefix' ] == 'yes' ? '&#36;' : '') . $amountvalue . '</li>';
                                                        }
                                                        $amountnextstep = $amountnextstep + $amountinterval;
                                                        $amountvalue = number_format(ceil($amountnextstep), 0, ',', '.');
                                                    }
                                                ?>
                                                </ul>
                                                <?php endif; ?>
                                            </div>
                                            <div class="range__header mb-medium w-80" id="timeheader_<?php echo $checklist_count ?>"><p><?php echo $item[ 'checklist_time_range_header_text' ] ?></p></div>
                                            <div class="range__wrapper checklist-range-wrapper w-80 mb-small" id="checklist-timerange_<?php echo $checklist_count ?>">
                                                <div class="range__value checklist-range-value" id="timevalue_<?php echo $checklist_count ?>"></div>
                                                <input class="checklist-range__input" id="timeinput_<?php echo $checklist_count ?>" type="range" min="<?php echo $item[ 'checklist_time_range_min' ]; ?>" max="<?php echo $item[ 'checklist_time_range_max' ]; ?>" step="<?php echo $item[ 'checklist_time_range_step' ]; ?>" data-fill="<?php echo $item[ 'checklist_time_range_color' ]; ?>">
                                                <?php if( $item[ 'show_checklist_time_range_labels' ] == 'yes' ) : ?>
                                                <ul id="timelabellist_<?php echo $checklist_count ?>" class="checklist-range-labellist">
                                                <?php
                                                    //Dynamic cheklist time-range labels
                                                    $timemin = (float)$item [ 'checklist_time_range_min' ];
                                                    $timemax = (float)$item [ 'checklist_time_range_max' ];
                                                    $timeinterval = ($timemax - $timemin) / 5;
                                                    $timenextstep = $timemin;
                                                    $timevalue = $timemin;

                                                    for ($z = 0; $z < 6; $z++){
                                                        if ($z == 5){ 
                                                            echo '<li class="range__label">' . ($item[ 'show_checklist_time_range_dollar_prefix' ] == 'yes' ?  '&#36;' : '') . $timevalue . ($item[ 'show_checklist_time_range_max_suffix' ] == 'yes' ? '&#43;' : '') .'</li>';       
                                                        }
                                                        else{
                                                            echo '<li class="range__label">' . ($item[ 'show_checklist_time_range_dollar_prefix' ] == 'yes' ? '&#36;' : '') . $timevalue . '</li>';
                                                        }
                                                        $timenextstep = $timenextstep + $timeinterval;
                                                        $timevalue = number_format(ceil($timenextstep), 0, ',', '.');
                                                    }
                                                ?>
                                                </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                    $checklist_count++;
                                    endforeach; 
                                ?>
                                </ul>
                            </div>
                        </fieldset>
                        <fieldset class="roi-row flex-row-space-between">
                            <label class="roi-left">
                                <p class="roi-left__label money-range-label"><?php echo $settings[ 'money_range_label_text' ]; ?></p>
                                <?php if( $settings[ 'show_money_range_label_tip' ] == 'yes') : ?>
                                    <span class="roi-tip-trigger flex-center" style="height: <?php echo $settings[ 'tip-icon_size' ]['size']?><?php echo $settings[ 'tip-icon_size' ]['unit'] ?>; width: <?php echo $settings[ 'tip-icon_size' ]['size']?><?php echo $settings[ 'tip-icon_size' ]['unit'] ?>;"><p>?</p></span>
                                    <span class="roi-tip money-range-tip">
                                        <p><?php echo $settings[ 'money_range_tip_text' ]; ?></p>
                                    </span>
                                <?php endif; ?>
                            </label>
                            <div class="roi-right">
                                <div class="range__wrapper money-range-wrapper w-100">
                                        <div class="range__value money-range-value" id="money-range__value"></div>
                                        <input id="money-range" type="range" min="<?php echo $settings[ 'money_range_min' ]; ?>" max="<?php echo $settings[ 'money_range_max' ]; ?>" step="<?php echo $settings[ 'money_range_step' ]; ?>" data-fill="<?php echo $settings[ 'money_range_color' ]; ?>">
                                        <?php if( $settings[ 'show_money_range_labels' ] == 'yes' ) : ?>
                                            <ul id="range__labellist" class="money-range-labellist">
                                            <?php
                                                //Dynamic money-range labels
                                                $min = (float)$settings [ 'money_range_min' ];
                                                $max = (float)$settings [ 'money_range_max' ];
                                                $interval = ($max - $min) / 5;
                                                $nextstep = $min;
                                                $value = $min;

                                                for ($x = 0; $x < 6; $x++){
                                                    if ($x == 5){ 
                                                        echo '<li class="range__label">' . ($settings[ 'show_money_range_dollar_prefix' ] == 'yes' ?  '&#36;' : '') . $value . ($settings[ 'show_money_range_max_suffix' ] == 'yes' ? '&#43;' : '') .'</li>';       
                                                    }
                                                    else{
                                                        echo '<li class="range__label">' . ($settings[ 'show_money_range_dollar_prefix' ] == 'yes' ? '&#36;' : '') . $value . '</li>';
                                                    }
                                                    $nextstep = $nextstep + $interval;
                                                    $value = number_format(ceil($nextstep), 0, ',', '.');
                                                }
                                            ?>
                                            </ul>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </fieldset>                    
                        <fieldset class="roi-row flex-row-space-between">
                            <label class="roi-left">
                                <p class="roi-left__label form-label"><?php echo $settings[ 'form_label_text' ]; ?></p>
                                    <?php if( $settings[ 'show_form_label_tip' ] == 'yes') : ?>
                                            <span class="roi-tip-trigger flex-center" style="height: <?php echo $settings[ 'tip-icon_size' ]['size']?><?php echo $settings[ 'tip-icon_size' ]['unit'] ?>; width: <?php echo $settings[ 'tip-icon_size' ]['size']?><?php echo $settings[ 'tip-icon_size' ]['unit'] ?>;"><p>?</p></span>
                                            <span class="roi-tip form-tip">
                                                <p><?php echo $settings[ 'form_tip_text' ]; ?></p>
                                            </span>
                                        <?php endif; ?>
                            </label>
                            <div class="roi-right">
                                <input class="roi-form__textinput" name="firstname" placeholder="<?php echo $settings[ 'firstname_placeholder_text' ] ?>">
                                <input class="roi-form__textinput" name="lastname" placeholder="<?php echo $settings[ 'lastname_placeholder_text' ] ?>">
                                <input class="roi-form__textinput" name="email" placeholder="<?php echo $settings[ 'email_placeholder_text' ] ?>">
                                <input class="roi-form__textinput" name="phone" placeholder="<?php echo $settings[ 'phone_placeholder_text' ] ?>">
                            </div>
                        </fieldset>
                        <fieldset class="roi-row flex-center">
                            <button type="submit" class="roi-button roi-button--primary" id="roi-submit-button"><?php echo $settings[ 'submit_button_text' ] ?></button>
                        </fieldset>    
                    </form>
            <!-- End of form / Start of result -->
            <section id="roi-results" class="roi-contain --light">
                <div class="roi-inner --small">
                    <h1 class="roi-section-title">Summary of your results</h1>
                    <section class="tabs roi-tabs" id="js-tabs">
                    <ul class="tabs__nav text-center" role="tablist">
                        <li class="tabs__link" tabindex="0" role="tab" aria-controls="one-month" aria-selected="true">
                            <span>
                                <h3>1 Month</h3>
                            </span>
                        </li>
                        <li class="tabs__link" tabindex="-1" role="tab" aria-controls="one-year">
                            <span>
                                <h3>1 Year</h3>
                            </span>
                        </li>
                        <li class="tabs__link" tabindex="-1" role="tab" aria-controls="five-years">
                            <span>
                                <h3>5 Years</h3>
                            </span>
                        </li>
                    </ul>
                        <section class="tabs__panel" id="one-month" role="tabpanel">
                            <div class="roi-tabs__numbers">
                                <div id="monthly-money-saved" class="roi-tab__number --left">
                                    <h1><span class="roi-tab__dollar">$</span><span id="money-saved-month"></span></h1>
                                    <span class="roi-tab__saved">
                                    saved per month
                                    <span class="roi__tip-trigger">?</span>
                                    <span class="roi__tip">
                                        <p>Flywheel handles approximately 80% of the above tasks, based on client case studies and real customer data. We calculate money and hours saved using your hourly rate and the number of sites you build in a month. Please note that your actual results may vary.</p>
                                    </span>
                                    </span>
                                </div>
                                <div class="roi-tab__number --right">
                                    <h1 id="hours-saved-month"></h1>
                                    <span class="roi-tab__saved">hours saved per month</span>
                                </div>
                                <hr class="roi-tabs__divider">
                                <div class="roi-bottom-graphs">   
                                    <div class="roi-tabs__could">   
                                        <h2 class="roi-tabs__could-heading">With all that extra money and time you could...</h2>
                            
                                        <ul class="roi-tabs__extra">
                                        <li>
                                            <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Buy more coffee" data-lazy-src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-cup.svg"><noscript><img src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-cup.svg" alt="Buy more coffee"></noscript>
                                            <p>Buy <span id="coffee-month"></span> cups of coffee</p>
                                        </li>
                                        <li>
                                            <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Build more sites" data-lazy-src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-computer.svg"><noscript><img src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-computer.svg" alt="Build more sites"></noscript>
                                            <p>Build <span id="sites-month"></span> more site(s)</p>
                                        </li>
                                        <li>
                                            <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Snooze longer" data-lazy-src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-hourglass.svg"><noscript><img src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-hourglass.svg" alt="Snooze longer"></noscript>
                                            <p>Snooze <span id="snooze-month"></span> extra hours</p>
                                        </li>
                                        </ul>
                                    </div>
                            
                                    <form class="roi-pdf-form">
                                        <div class="roi-pdf-form__title">
                                        <h1>Get your full ROI report!</h1>
                                        <p>To download a complete, customized report, use the button below and we’ll generate it for you in a flash.</p>
                                        </div>
                            
                                        <button class="roi-pdf-form__btn">Send my report</button>
                                    </form>
                                </div>
                            </div>
                        </section>
                
                        <section class="tabs__panel" id="one-year" role="tabpanel" aria-hidden="true">
                            <div class="roi-tabs__numbers">
                                <div id="yearly-money-saved" class="roi-tab__number --left money-saved-contain">
                                    <h1><span class="roi-tab__dollar">$</span><span id="money-saved-year"></span></h1>
                                    <span class="roi-tab__saved">
                                    saved per year
                                    <span class="roi__tip-trigger">?</span>
                                    <span class="roi__tip">
                                        <p>Flywheel handles approximately 80% of the above tasks, based on client case studies and real customer data. We calculate money and hours saved using your hourly rate and the number of sites you build in a month. Please note that your actual results may vary.</p>
                                    </span>
                                    </span>
                                </div>
                                <div class="roi-tab__number --right">
                                    <h1 id="hours-saved-year"></h1>
                                    <span class="roi-tab__saved">hours saved per year</span>
                                </div>
                            </div>   
                            <hr class="roi-tabs__divider">    
                            <div class="roi-bottom-graphs">    
                                <div class="roi-tabs__could">    
                                    <h2 class="roi-tabs__could-heading">With all that extra money and time you could...</h2>
                        
                                    <ul class="roi-tabs__extra">
                                    <li>
                                        <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Buy more coffee" data-lazy-src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-cup.svg"><noscript><img src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-cup.svg" alt="Buy more coffee"></noscript>
                                        <p>Buy <span id="coffee-year"></span> cups of coffee</p>
                                    </li>
                                    <li>
                                        <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Build more sites" data-lazy-src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-computer.svg"><noscript><img src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-computer.svg" alt="Build more sites"></noscript>
                                        <p>Build <span id="sites-year"></span> more site(s)</p>
                                    </li>
                                    <li>
                                        <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Snooze longer" data-lazy-src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-hourglass.svg"><noscript><img src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-hourglass.svg" alt="Snooze longer"></noscript>
                                        <p>Snooze <span id="snooze-year"></span> extra hours</p>
                                    </li>
                                    </ul>
                                </div>
                                <form class="roi-pdf-form">
                                    <div class="roi-pdf-form__title">
                                    <h1>Get your full ROI report!</h1>
                                    <p>To download your complete, customized report, fill out the following information and we’ll generate it for you in a flash.</p>
                                    </div>
                        
                                    <button class="roi-pdf-form__btn">Send my report</button>
                                </form>
                            </div>
                        </section>
                    
                        <section class="tabs__panel" id="five-years" role="tabpanel" aria-hidden="true">
                            <div class="roi-tabs__numbers">
                                <div id="five-money-saved" class="roi-tab__number --left large-text">
                                    <h1><span class="roi-tab__dollar">$</span><span id="money-saved-five"></span></h1>
                                    <span class="roi-tab__saved">
                                    saved over five years
                                    <span class="roi__tip-trigger">?</span>
                                    <span class="roi__tip">
                                        <p>Consider how much time it takes you or your team to deal with malware, downtime, WordPress updates, or slow site speeds. For each site, how much time do you spend on these issues? </p>
                                    </span>
                                    </span>
                                </div>
                                <div class="roi-tab__number --right large-text">
                                    <h1 id="hours-saved-five"></h1>
                                    <span class="roi-tab__saved">hours saved over five years</span>
                                </div>
                            </div>    
                            <hr class="roi-tabs__divider">    
                            <div class="roi-bottom-graphs">    
                                <div class="roi-tabs__could">    
                                <h2 class="roi-tabs__could-heading">With all that extra money and time you could...</h2>
                    
                                <ul class="roi-tabs__extra">
                                <li>
                                    <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Buy more coffee" data-lazy-src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-cup.svg"><noscript><img src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-cup.svg" alt="Buy more coffee"></noscript>
                                    <p>Buy <span id="coffee-five"></span> cups of coffee</p>
                                </li>
                                <li>
                                    <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Build more sites" data-lazy-src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-computer.svg"><noscript><img src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-computer.svg" alt="Build more sites"></noscript>
                                    <p>Build <span id="sites-five"></span> more site(s)</p>
                                </li>
                                <li>
                                    <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Snooze longer" data-lazy-src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-hourglass.svg"><noscript><img src="https://p08cv792n4-flywheel.netdna-ssl.com/wp-content/themes/flywheel15/images/icon-hourglass.svg" alt="Snooze longer"></noscript>
                                    <p>Snooze <span id="snooze-five"></span> extra hours</p>
                                </li>
                                </ul>
                            </div>
                            <form class="roi-pdf-form">
                                <div class="roi-pdf-form__title">
                                <h1>Get your full ROI report!</h1>
                                <p>To download your complete, customized report, fill out the following information and we’ll generate it for you in a flash.</p>
                                </div>
                                <button class="roi-pdf-form__btn">Send my report</button>
                            </form>
                        </div>
                    </section>
                </div>
            </section>
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
        }

}
Plugin::instance()->widgets_manager->register_widget_type( new ROI_Calculator_Widget() );