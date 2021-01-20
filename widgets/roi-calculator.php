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
                'label' => __( 'Base Typography', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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


        // Form Tip Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'form_tip_typography',
				'label' => __( '(Form)Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .roi-tip',
			]
        );


        // Result Tip Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'result_tip_typography',
				'label' => __( '(Result)Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .result-box__tip',
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

        // Label Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'general_label_typography',
				'label' => __( 'General Label Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .roi-left__label',
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
            'more_options_checklist_label_tip',
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
				'name' => 'form_label_tip_typography',
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
                'label' => __( 'Calculate-button', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Submit-button Text
        $this->add_control(
            'submit_button_text',
            [
                'label' => __( 'Button Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Calculate', 'roi-calculator-widget' ),
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

        // Result Settings
        $this->start_controls_section(
            'result_tabs_settings',
            [
                'label' => __( 'Result', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        // Result main heading 
        $this->add_control(
            'result_main_heading',
            [
                'label' => __( 'Heading for result', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Summary of your calculation' , 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter heading-text', 'roi-calculator-widget' ),
                'label_block' => true,
            ]
        );

        // Result main heading typography 
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'result_main_heading_typography',
				'label' => __( 'Heading typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #roi-result-heading',
			]
        );

        // Result heading text-color
        $this->add_control(
            'result_main_heading_color',
            [
                'label' => __( 'Heading text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2AAECD',
                'description' => 'Default: ( #2AAECD ) ',
                'selectors' => [
                    '{{WRAPPER}} #roi-result-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'more_options_result_tabs',
            [
                'label' => __( 'Result-sections', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Result-Tabs 
        $this->start_controls_tabs(
            'result_tabs'
        );

        //Result-years tab
        $this->start_controls_tab(
            'result_year_tabs_tab',
            [
                'label' => __( 'Year-tabs', 'roi-calculator-widget' ),
            ]
        );

        // Result-years Typography 
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'result_tabs_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tabs__link',
			]
        );

        // Result-years active text-color
        $this->add_control(
            'result_tabs_active_text_color',
            [
                'label' => __( 'Active Tab text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#54595f',
                'description' => 'Default: ( #54595f ) ',
                'selectors' => [
                    '{{WRAPPER}} .tabs__link--active' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Result-years inactive text-color
        $this->add_control(
            'result_tabs_inactive_text_color',
            [
                'label' => __( 'Inative Tabs text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#B3B3B3',
                'description' => 'Default: ( #B3B3B3 ) ',
                'selectors' => [
                    '{{WRAPPER}} .tabs__link--inactive' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        //Result-saved tab
        $this->start_controls_tab(
            'result_saved_tab',
            [
                'label' => __( 'Saved', 'roi-calculator-widget' ),
            ]
        );

        // Result-saved Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'result_saved_typography',
				'label' => __( 'Saved Money/Time Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .result-box__saved',
			]
        );

        // Result-saved money/time Color
        $this->add_control(
            'result_saved_money_time_color',
            [
                'label' => __( 'Saved Money/Time Text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#54595f',
                'description' => 'Default: ( #54595f ) ',
                'selectors' => [
                    '{{WRAPPER}} .result-box__saved' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Saved money one year sub-text 
        $this->add_control(
            'saved_money_sub_text',
            [
                'label' => __( 'Saved Money Sub-text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'SEK Saved', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter sub-text', 'roi-calculator-widget' ),
            ]
        );

        // Saved time one year sub-text 
        $this->add_control(
            'saved_time_sub_text',
            [
                'label' => __( 'Saved Time Sub-text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Hours Saved', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter sub-text', 'roi-calculator-widget' ),
            ]
        );

        // Result-saved text Typography 
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'result_saved_text_typography',
				'label' => __( 'Sub-text Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .result-box__text',
			]
        );

        // Result-saved Text text-color
        $this->add_control(
            'result_saved_text_textcolor',
            [
                'label' => __( 'Sub-text Text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#54595f',
                'description' => 'Default: ( #54595f ) ',
                'selectors' => [
                    '{{WRAPPER}} .result-box__text' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Result-saved dollar-prefix 
        $this->add_control(
            'show_saved_money_dollar_prefix',
            [
                'label' => __( 'Show money-prefix: $ ', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator-widget' ),
                'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Result-saved dollar-prefix Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'result_saved_dollar_typography',
				'label' => __( 'Dollar-prefix Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .result-box__dollar',
                'condition' => [
                    'show_saved_money_dollar_prefix' => 'yes'
                ],
			]
        );


        // Result-saved show money tip-trigger 
        $this->add_control(
            'show_saved_money_tip_trigger',
            [
                'label' => __( 'Saved Money Tip-trigger ', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator-widget' ),
                'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Saved money tip Text
        $this->add_control(
            'saved_money_tip_text',
            [
                'label' => __( 'Saved Money Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Tip text goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for tip', 'roi-calculator-widget' ),
                'condition' => [
                    'show_saved_money_tip_trigger' => 'yes'
                ]
            ]
        );

        // Result-saved show time tip-trigger 
        $this->add_control(
            'show_saved_time_tip_trigger',
            [
                'label' => __( 'Saved Time Tip-trigger ', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator-widget' ),
                'label_off' => __( 'Hide', 'roi-calculator-widget' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Saved time tip-text 
        $this->add_control(
            'saved_time_tip_text',
            [
                'label' => __( 'Saved Time Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Tip text goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for tip', 'roi-calculator-widget' ),
                'condition' => [
                    'show_saved_time_tip_trigger' => 'yes'
                ]
            ]
        );

        $this->end_controls_tab();

        //Result Can-do tab 
        $this->start_controls_tab(
            'result_cando_tab',
            [
                'label' => __( 'Could-do', 'roi-calculator-widget' ),
            ]
        );

        // Result Can-do heading 
        $this->add_control(
            'result_cando_heading_text',
            [
                'label' => __( 'Heading', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'With all that extra money and time you could...' , 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter heading-text', 'roi-calculator-widget' ),
                'label_block' => true,
            ]
        );

        // Result Can-do heading typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'result_cando_heading_typography',
				'label' => __( 'Heading typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #roi-result-could-do-heading',
			]
        );

        // Result cando heading text-color
        $this->add_control(
            'result_cando_heading_color',
            [
                'label' => __( 'Heading text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2AAECD',
                'description' => 'Default: ( #2AAECD ) ',
                'selectors' => [
                    '{{WRAPPER}} #roi-result-could-do-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Icon Color 
        $this->add_control(
            'cando_icon_color',
            [
                'label' => __( 'Icon Color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2AAECD',
                'description' => 'Default: ( #2AAECD ) ',
                'selectors' => [
                    '{{WRAPPER}} .could-do__icon i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
			'cando_boxes_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
        );
        

        // Can-do Repeater
        $candorepeater = new \Elementor\Repeater();
        $candorepeater->add_control(
            'cando_title',
            [
                'label' => __( 'Title', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'roi-calculator-widget' ),
                'label_block' => true,
            ]
        );
        $candorepeater->add_control(
            'cando_icon',
            [
                'label' => __( 'Icon', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-coffee',
                    'library' => 'solid',
                ],
            ]
        );


        // Can-do time or price
        $candorepeater->add_control(
			'show_cando_price_money',
			[
				'label' => __( 'Calculate using:', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'price',
				'options' => [
					'price'  => __( 'Price', 'roi-calculator-widget' ),
					'time' => __( 'Time', 'roi-calculator-widget' ),
				],
			]
		);

        // Can-do price
        $candorepeater->add_control(
            'cando_price',
            [
                'label' => __( 'Price per each:', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000000,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'show_cando_price_money' => 'price'
                ],
                'description' => 'Specify the single unit price in order to calculate the amount of the chosen product you could buy with all the money that you save:<br>eg. How much does a single cup of coffee cost?'
            ]
        );

        // Can-do time
        $candorepeater->add_control(
            'cando_time',
            [
                'label' => __( 'Time spent in minutes per each:', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000000,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'show_cando_price_money' => 'time'
                ],
                'description' => 'Specify how many minutes a single occasion takes in order to calculate how many occasions of the chosen activity you could do for all the saved time:<br>eg. How many minutes for a single occasion of a sleep-in?'
            ]
        );

        // Can-do pre-text
        $candorepeater->add_control(
            'cando_pre_amount_text',
            [
                'label' => __( 'Pre-amount text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'roi-calculator-widget' ),
                'label_block' => true,
            ]
        );

        // Can-do after-text
        $candorepeater->add_control(
            'cando_after_amount_text',
            [
                'label' => __( 'After-amount text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'roi-calculator-widget' ),
                'label_block' => true,
            ]
        );


        // Can-do Typohraphy 
        $candorepeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cando_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .could-do__text',
			]
        );

        // Can-do Text Color 
        $candorepeater->add_control(
            'cando_text_color',
            [
                'label' => __( 'Icon Color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#54595f',
                'description' => 'Default: ( #54595f ) ',
                'selectors' => [
                    '{{WRAPPER}} .could-do__text' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'cando_boxes',
            [
                'label' => __( 'Could-do List', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $candorepeater->get_controls(),
                'default' => [
                    [
                        'cando_title' => __( 'Coffee', 'roi-calculator-widget' ),
                    ],
                ],
                'title_field' => '{{{ cando_title }}}',
            ]
        );        
        

        $this->end_controls_tab();

        //Result Summary tab 
        $this->start_controls_tab(
            'result_summary_tab',
            [
                'label' => __( 'Summary', 'roi-calculator-widget' ),
            ]
        );

        // Result Summary heading 
        $this->add_control(
            'result_summary_heading_text',
            [
                'label' => __( 'Heading', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Summary of your ROI-calculation' , 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter heading-text', 'roi-calculator-widget' ),
                'label_block' => true,
            ]
        );


        // Result Summary heading typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'result_summary_heading_typography',
				'label' => __( 'Heading typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #roi-result-summary-heading',
			]
        );

        // Result Summary heading text-color
        $this->add_control(
            'result_summary_heading_color',
            [
                'label' => __( 'Heading text-color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2AAECD',
                'description' => 'Default: ( #2AAECD ) ',
                'selectors' => [
                    '{{WRAPPER}} #roi-result-summary-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Result Summary Text
        $this->add_control(
            'result_summary_text',
            [
                'label' => __( 'Summary text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'The summarytext of your ROI-calculation...', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for summary', 'roi-calculator-widget' ),
            ]
        );

        // Result Summary text typography 
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'result_summary_text_typography',
				'label' => __( 'Summary-text typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #roi-result-summary-text',
			]
        );

        // Result Summary text text-color
        $this->add_control(
            'result_summary_text_color',
            [
                'label' => __( 'Summary-text color', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#54595f',
                'description' => 'Default: ( #54595f ) ',
                'selectors' => [
                    '{{WRAPPER}} #roi-result-summary-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Show Summary CTA-button
        $this->add_control(
            'show_result_summary_cta',
            [
                'label' => __( 'Show CTA-button', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator' ),
                'label_off' => __( 'Hide', 'roi-calculator' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // CTA-button Text 
        $this->add_control(
            'result_cta_button_text',
            [
                'label' => __( 'Button Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Go', 'roi-calculator-widget' ),
                'label_block' => true,
                'placeholder' => __( 'Enter button-text here', 'roi-calculator-widget' ),
                'condition' => [
                    'show_result_summary_cta' => 'yes'
                ]
            ]
        );

        // CTA-button Typography 
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cta_button_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} #roi-result-cta-button',
                'condition' => [
                    'show_result_summary_cta' => 'yes'
                ],
			]
        );

        // CTA-button link
        $this->add_control(
			'result_cta_button_link',
			[
				'label' => __( 'Link', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'roi-calculator-widget' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
                ],
                'condition' => [
                    'show_result_summary_cta' => 'yes'
                ],
			]
		);

        $this->end_controls_tab();


        $this->end_controls_tabs();
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
                        '{{WRAPPER}} .result-box__tip' => 'color: {{VALUE}};',
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


        // Submit-button Style Settings
        $this->start_controls_section(
            'submit_button_style_section',
            [
                'label' => __( 'Calculate-button', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

                // Submit-button border Color
                $this->add_control(
                    'submit_button_default_border_color',
                    [
                        'label' => __( 'Border Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#2AAECD',
                        'description' => 'Default: ( #2AAECD ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-submit-button ' => 'border-color: {{VALUE}}',
                        ],
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
                        'label' => __( 'Text Color', 'roi-calculator-widget' ),
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

                // Submit-button border Color
                $this->add_control(
                    'submit_button_hover_border_color',
                    [
                        'label' => __( 'Border Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#2AAECD',
                        'description' => 'Default: ( #2AAECD ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-submit-button:hover ' => 'border-color: {{VALUE}}',
                        ],
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


        // cta-button Style Settings
        $this->start_controls_section(
            'cta_button_style_section',
            [
                'label' => __( 'CTA-button', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );        

            $this->add_control(
                'more_options_cta_button_hover',
                [
                    'label' => __( 'Default/Hover Styles', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            // cta-Button Tabs
            $this->start_controls_tabs(
                'cta_button_style_tabs'
            );

            /* ********** NORMAL STATE BEGIN ************* */

            $this->start_controls_tab(
                'cta_button_normal_state',
                [
                    'label' => __( 'Default Style', 'roi-calculator-widget' ),
                ]
            );

                // cta-button border Color 
                $this->add_control(
                    'cta_button_default_border_color',
                    [
                        'label' => __( 'Border Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#2AAECD',
                        'description' => 'Default: ( #2AAECD ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-result-cta-button ' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

                // cta-button Background Color
                $this->add_control(
                    'cta_button_background_color',
                    [
                        'label' => __( 'Background Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#FFFFFF',
                        'description' => 'Default: ( #FFFFFF ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-result-cta-button ' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                //cta-button text-color
                $this->add_control(
                    'cta_button_text_color',
                    [
                        'label' => __( 'Text Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#2AAECD',
                        'description' => 'Default: ( #2AAECD ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-result-cta-button' => 'color: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();
            /* ********** NORMAL STATE END ************* */

            /* ********** HOVER STATE BEGIN ************* */

            $this->start_controls_tab(
                'cta_button_hover_state',
                [
                    'label' => __( 'Hover-Style', 'roi-calculator-widget' ),
                ]
            );

                // cta-button border Color 
                $this->add_control(
                    'cta_button_hover_border_color',
                    [
                        'label' => __( 'Border Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#2AAECD',
                        'description' => 'Default: ( #2AAECD ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-result-cta-button:hover ' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

                // Background Color
                $this->add_control(
                    'cta_button_hover_bg_color',
                    [
                        'label' => __( 'Background Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#2AAECD',
                        'description' => 'Default: ( #2AAECD ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-result-cta-button:hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                // Text Color
                $this->add_control(
                    'cta_button_hover_text_color',
                    [
                        'label' => __( 'Text Color', 'roi-calculator-widget' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#FFFFFF',
                        'description' => 'Default: ( #FFFFFF ) ',
                        'selectors' => [
                            '{{WRAPPER}} #roi-result-cta-button:hover' => 'color: {{VALUE}}',
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
        //Button link
        $button_target = $settings[ 'result_cta_button_link' ][ 'is_external' ] ? ' target="_blank"' : '';
        $button_nofollow = $settings[ 'result_cta_button_link' ][ 'nofollow' ] ? ' rel="nofollow"' : '';

        if ( Plugin::$instance->editor->is_edit_mode() ) : ?>
            <script>
                //Range-Class
                class RangeInput {
                constructor(inputId, valueId, color) {
                    this.rangeinput = $(inputId);
                    this.valueBubble = $(valueId);
                    this.leftfill = color;
                    this.value;
                    this.events();
                    this.setValue();
                }
                events() {
                    this.rangeinput.on("input", this.setValue.bind(this));
                }

                setValue(){
                //Set value for value-bubble
                this.value = this.rangeinput.val();
                let newValue = Number( (this.rangeinput.val() - this.rangeinput.attr("min")) * 100 / (this.rangeinput.attr("max") - this.rangeinput.attr("min")) );
                let newPosition = 10 - (newValue * 0.2);
                this.valueBubble.html(`<span>${this.value}</span>`);
                this.valueBubble.css("left", `calc(${newValue}% + (${newPosition}px))`);

                //Add background to fill leftside of thumb
                let value = (this.rangeinput.val()-this.rangeinput.attr("min"))/(this.rangeinput.attr("max")-this.rangeinput.attr("min"))*100
                this.rangeinput.css("background", `linear-gradient(to right, ${this.leftfill} 0%, ${this.leftfill} ${value}%, #fff ${value}%, white 100%)`);
                }
                }

                const $ = jQuery;
                $(function() {
                    //Checkbox
                    let checkboxes = $(".roi-checklist__checkbox");
                    let rangewrappers = $(".checklist-rangewrapper");

                    for (let i = 0; i < checkboxes.length; i++){
                        $(checkboxes[i]).change(()=>{
                            if ( $(checkboxes[i]).is(':checked') ){
                                $(rangewrappers[i]).slideDown();
                            }else{
                                $(rangewrappers[i]).slideUp();
                            }
                        });
                    }

                    //Ranges
                    const checklistRangeValues = $(".checklist-range-value");
                    const checklistRangeInputs = $(".checklist-range__input");
                    for (let i = 0; i < checklistRangeValues.length; i++){
                        new RangeInput(`#${checklistRangeInputs[i].id}`, `#${checklistRangeValues[i].id}`, $(checklistRangeInputs[i]).data("fill"));
                    }
                    const moneyRange = $("#money-range");
                    new RangeInput("#money-range", "#money-range__value", $(moneyRange).data("fill"));
                })
            </script>

        <?php endif; ?>

        

    <div class="roi-outer-wrapper">
        <section class="roi-inner-wrapper">
                    <form class="roi-display-section mb-large" id="roi-calculation-form">                    
                        <div class="roi-row flex-space-between">
                            <label class="roi-left">
                                <p class="roi-left__label checklist-label"><?php echo $settings[ 'checklist_label_text' ]; ?></p>
                                <?php if( $settings[ 'show_checklist_label_tip' ] == 'yes') : ?>
                                    <span class="roi-tip-trigger flex-center"><p>?</p></span>
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
                                            <span class="roi-checklist__icon flex-center">
                                                <?php \Elementor\Icons_Manager::render_icon( $item['checklist_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </span>
                                            <span class="roi-checklist__labeltext">
                                                <?php echo $item[ 'checklist_text' ]; ?>
                                            </span>
                                        </li>
                                    </label>
                                        <div class="checklist-rangewrapper hidden">
                                        <div class="flex flex-column flex-end mb-medium">
                                            <div class="range__header mb-medium inset-small" id="amountheader_<?php echo $checklist_count ?>"><p><?php echo $item[ 'checklist_amount_range_header_text' ] ?></p></div>
                                            <div class="range__wrapper checklist-range-wrapper inset-small mb-small" id="checklist-amountrange_<?php echo $checklist_count ?>">
                                                <div class="range__value checklist-range-value checklist-range-value__amount" id="amountvalue_<?php echo $checklist_count ?>"></div>
                                                <input class="checklist-range__input checklist-range__amount" id="amountinput_<?php echo $checklist_count ?>" type="range" min="<?php echo $item[ 'checklist_amount_range_min' ]; ?>" max="<?php echo $item[ 'checklist_amount_range_max' ]; ?>" step="<?php echo $item[ 'checklist_amount_range_step' ]; ?>" data-fill="<?php echo $item[ 'checklist_amount_range_color' ]; ?>">
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
                                            <div class="range__header mb-medium inset-small" id="timeheader_<?php echo $checklist_count ?>"><p><?php echo $item[ 'checklist_time_range_header_text' ] ?></p></div>
                                            <div class="range__wrapper checklist-range-wrapper inset-small mb-small" id="checklist-timerange_<?php echo $checklist_count ?>">
                                                <div class="range__value checklist-range-value checklist-range-value__time" id="timevalue_<?php echo $checklist_count ?>"></div>
                                                <input class="checklist-range__input checklist-range__time" id="timeinput_<?php echo $checklist_count ?>" type="range" min="<?php echo $item[ 'checklist_time_range_min' ]; ?>" max="<?php echo $item[ 'checklist_time_range_max' ]; ?>" step="<?php echo $item[ 'checklist_time_range_step' ]; ?>" data-fill="<?php echo $item[ 'checklist_time_range_color' ]; ?>">
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
                        </div>
                        <div class="roi-row flex-space-between">
                            <label class="roi-left">
                                <p class="roi-left__label money-range-label"><?php echo $settings[ 'money_range_label_text' ]; ?></p>
                                <?php if( $settings[ 'show_money_range_label_tip' ] == 'yes') : ?>
                                    <span class="roi-tip-trigger flex-center"><p>?</p></span>
                                    <span class="roi-tip money-range-tip">
                                        <p><?php echo $settings[ 'money_range_tip_text' ]; ?></p>
                                    </span>
                                <?php endif; ?>
                            </label>
                            <div class="roi-right">
                                <div class="range__wrapper money-range-wrapper">
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
                        </div>                    
                        <div class="roi-row flex-space-between">
                            <label class="roi-left">
                                <p class="roi-left__label form-label"><?php echo $settings[ 'form_label_text' ]; ?></p>
                                    <?php if( $settings[ 'show_form_label_tip' ] == 'yes') : ?>
                                            <span class="roi-tip-trigger flex-center"><p>?</p></span>
                                            <span class="roi-tip form-tip">
                                                <p><?php echo $settings[ 'form_tip_text' ]; ?></p>
                                            </span>
                                        <?php endif; ?>
                            </label>
                            <div class="roi-right">
                                <input class="roi-form__textinput" id="roi-input__firstname" name="firstname" placeholder="<?php echo $settings[ 'firstname_placeholder_text' ] ?>">
                                <input class="roi-form__textinput" id="roi-input__lastname" name="lastname" placeholder="<?php echo $settings[ 'lastname_placeholder_text' ] ?>">
                                <input class="roi-form__textinput" id="roi-input__email" name="email" placeholder="<?php echo $settings[ 'email_placeholder_text' ] ?>">
                                <input class="roi-form__textinput" id="roi-input__phone" name="phone" placeholder="<?php echo $settings[ 'phone_placeholder_text' ] ?>">
                            </div>
                        </div>
                        <div class="roi-row flex-center">
                            <button type="submit" class="roi-button roi-button--primary" id="roi-submit-button"><?php echo $settings[ 'submit_button_text' ] ?></button>
                        </div>    
                    </form>
            <!-- End of form / Start of result -->
            <?php echo '<section id="roi-results" class="flex flex-center ' . ( Plugin::$instance->editor->is_edit_mode() ? '' : 'hidden' ) .'">' ?>
                <div class="roi-inner-wrapper__small">
                    <h1 id="roi-result-heading" class="heading--primary flex flex-center"><?php echo $settings[ 'result_main_heading' ] ?></h1>
                    <section class="tabs__wrapper">
                            <ul class="tabs__nav text-center">
                                <li class="tabs__link tabs__link--active" data-time="12">
                                    <h3 id="tabs-one-year">1 Month</h3>
                                </li>
                                <li class="tabs__link tabs__link--inactive" data-time="36">
                                    <h3 id="tabs-three-year">1 Year</h3>
                                </li>
                                <li class="tabs__link tabs__link--inactive" data-time="60">
                                    <h3 id="tabs-five-year">5 Years</h3>
                                </li>
                            </ul>
                        </section>
                    <div class="roi-result-wrapper">
                        <section class="roi-display-section" id="roi-calculation-result">
                            <div class="roi-row roi-row--border">
                                <div class="result-box result-box--border-right max-half-col flex flex-column flex-center">
                                    <h1 class="result-box__saved">
                                    <?php if ($settings[ 'show_saved_money_dollar_prefix' ] == 'yes') : ?>
                                        <span class="result-box__dollar">$</span>
                                    <?php endif; ?>
                                    <span id="money-saved">5</span></h1>
                                    <span class="result-box__text">
                                    <?php echo $settings[ 'saved_money_sub_text' ] ?>
                                    <?php if ($settings[ 'show_saved_money_tip_trigger' ]) : ?> 
                                        <span class="result-box__tip-trigger flex flex-center"><p>?</p></span>
                                        <span class="result-box__tip">
                                            <p><?php echo $settings[ 'saved_money_tip_text' ] ?></p>
                                        </span>
                                    <?php endif; ?>
                                    </span>
                                </div>
                                <div class="result-box max-half-col flex flex-column flex-center">
                                    <h1 class="result-box__saved" id="hours-saved">20</h1>
                                    <span class="result-box__text"><?php echo $settings[ 'saved_time_sub_text' ] ?>
                                    <?php if ($settings[ 'show_saved_time_tip_trigger' ]) : ?> 
                                        <span class="result-box__tip-trigger flex flex-center"><p>?</p></span>
                                        <span class="result-box__tip">
                                            <p><?php echo $settings[ 'saved_time_tip_text' ] ?></p>
                                        </span>
                                    <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                            <hr class="roi-divider" />
                            <div class="roi-row flex-center">
                                <h2 id="roi-result-could-do-heading" class="heading--primary"><?php echo $settings[ 'result_cando_heading_text' ] ?></h2>
                            </div>
                            <div class="roi-row flex-start">   
                            <?php foreach( $settings[ 'cando_boxes' ] as $candoitem  ) : ?>
                                <div class="result-box max-third-col">
                                    <span class="could-do__icon flex flex-center">
                                        <?php \Elementor\Icons_Manager::render_icon( $candoitem['cando_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                    <p class="could-do__text">
                                        <span class="could-do__pre-text"><?php echo $candoitem[ 'cando_pre_amount_text' ] ?></span>
                                        <?php
                                            echo '<span class="could-do__cost"' . ($candoitem[ 'show_cando_price_money' ] == 'price' ?  'data-cost="' . $candoitem[ 'cando_price' ] .'">' : 'data-time="' . $candoitem[ 'cando_time' ] . '">') . '</span>';
                                        ?>
                                        <span class="could-do__sub-text"><?php echo $candoitem[ 'cando_after_amount_text' ] ?></span>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                            </div>
                            <div class="roi-row flex-center">
                                <div class="result-summary flex flex-column flex-center">
                                    <h1 id="roi-result-summary-heading" class="heading--primary"><?php echo $settings[ 'result_summary_heading_text' ] ?></h1>
                                    <p id="roi-result-summary-text" class="result-summary__text"><?php echo $settings[ 'result_summary_text' ] ?></p>
                                </div>
                            </div>
                            <?php if ($settings[ 'show_result_summary_cta' ] == 'yes' ) : ?>
                            <div class="roi-row flex-center">
                                <a href="<?php echo esc_url( $settings[ 'result_cta_button_link' ][ 'url' ] ); ?>" <?php echo $button_target; ?> <?php echo $button_nofollow ?>>
                                    <button class="roi-button roi-button--primary" id="roi-result-cta-button"><?php echo $settings[ 'result_cta_button_text' ] ?></button>
                                </a>
                            </div>
                            <?php endif; ?>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </div>
    <?php
    }

    protected function _content_template() {}

}
Plugin::instance()->widgets_manager->register_widget_type( new ROI_Calculator_Widget() );