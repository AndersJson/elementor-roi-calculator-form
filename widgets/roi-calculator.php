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
        // Row Settings
        $this->start_controls_section(
            'form_row_settings',
            [
                'label' => __( 'General', 'roi-calculator-widget' ),
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
                'name' => 'first_tip_trigger_typography',
                'label' => __( 'Tip Trigger Font', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .roi-tip-trigger',
            ]
        );

        // Tip Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'first_tip_typography',
				'label' => __( 'Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .roi-tip',
			]
        );

        $this->add_control(
            'more_options_row_order',
            [
                'label' => __( 'Row order', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        //Row order 1
        $this->add_control(
			'row_order_first',
			[
				'label' => __( 'Slider-row 1', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 1,
			]
        );
        
        //Row order 2
        $this->add_control(
			'row_order_second',
			[
				'label' => __( 'Checklist-row', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 2,
			]
        );
        
        //Row order 3
        $this->add_control(
			'row_order_third',
			[
				'label' => __( 'Slider-row 2', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 3,
			]
        );
        
        //Row order 4
        $this->add_control(
			'row_order_fourth',
			[
				'label' => __( 'Slider-row 3', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 4,
			]
        );
        
        //Row order 5
        $this->add_control(
			'row_order_fifth',
			[
				'label' => __( 'Form-row', 'roi-calculator-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 5,
			]
		);



        $this->end_controls_section();


        //Slider-Label 1
        $this->start_controls_section(
            'first_label_settings',
            [
                'label' => __( 'Slider-Label 1', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'more_options_first_label',
            [
                'label' => __( 'Label', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Slider-Label 1 Text
        $this->add_control(
            'first_label_text',
            [
                'label' => __( 'Label text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Label text', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for label', 'roi-calculator-widget' ),
            ]
        );

        // Slider-Label 1 Typography
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
            'more_options_first_label_tip',
            [
                'label' => __( 'Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Slider-Label 1 Tip
        $this->add_control(
            'show_first_label_tip',
            [
                'label' => __( 'Show Label Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator' ),
                'label_off' => __( 'Hide', 'roi-calculator' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        // Slider-Tip 1 text
        $this->add_control(
            'first_tip_text',
            [
                'label' => __( 'Tip Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Explanation and tip goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Type your tip here', 'roi-calculator-widget' ),
                'condition' => [
                    'show_first_label_tip' => 'yes'
                ]
            ]
        );

        // Slider-Tip 1 Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'first_tip_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .first-tip',
			]
        );

        
        $this->end_controls_section();

        //Checklist-Label
        $this->start_controls_section(
            'checklist_label_settings',
            [
                'label' => __( 'Checklist-Label', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'more_options_checklist_label',
            [
                'label' => __( 'Label', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
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
				'selector' => '{{WRAPPER}} .second-label',
			]
        );
        
        $this->add_control(
            'more_options_first_label_tip',
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
				'selector' => '{{WRAPPER}} .second-tip',
			]
        );

        
        $this->end_controls_section();

        // Checklist Settings
        $this->start_controls_section(
            'checklist_settings',
            [
                'label' => __( 'Checklist', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        // Checklist Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'checklist_label_typography',
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

        //Slider-Label 2
        $this->start_controls_section(
            'third_label_settings',
            [
                'label' => __( 'Slider-Label 2', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'more_options_third_label',
            [
                'label' => __( 'Label', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Slider-Label 2 Text
        $this->add_control(
            'third_label_text',
            [
                'label' => __( 'Label text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Label text', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for label', 'roi-calculator-widget' ),
            ]
        );

        // Slider-Label 2 Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'third_label_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .third-label',
			]
        );
        
        $this->add_control(
            'more_options_third_label_tip',
            [
                'label' => __( 'Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Slider-Label 2 Tip
        $this->add_control(
            'show_third_label_tip',
            [
                'label' => __( 'Show Label Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator' ),
                'label_off' => __( 'Hide', 'roi-calculator' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        // Slider-Tip 2 text
        $this->add_control(
            'third_tip_text',
            [
                'label' => __( 'Tip Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Explanation and tip goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Type your tip here', 'roi-calculator-widget' ),
                'condition' => [
                    'show_third_label_tip' => 'yes'
                ]
            ]
        );

        // Slider-Tip 2 Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'third_tip_typography',
				'label' => __( 'Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .third-tip',
			]
        );

        
        $this->end_controls_section();

        //Slider-Label 3
        $this->start_controls_section(
            'forth_label_settings',
            [
                'label' => __( 'Slider-Label 3', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'more_options_forth_label',
            [
                'label' => __( 'Label', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Slider-Label 3 Text
        $this->add_control(
            'forth_label_text',
            [
                'label' => __( 'Label text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Label text', 'roi-calculator-widget' ),
                'placeholder' => __( 'Enter text for label', 'roi-calculator-widget' ),
            ]
        );

        // Slider-Label 3 Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'forth_label_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .forth-label',
			]
        );
        
        $this->add_control(
            'more_options_forth_label_tip',
            [
                'label' => __( 'Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Slider-Label 3 Tip
        $this->add_control(
            'show_forth_label_tip',
            [
                'label' => __( 'Show Label Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'roi-calculator' ),
                'label_off' => __( 'Hide', 'roi-calculator' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        // Slider-Tip 3 text
        $this->add_control(
            'forth_tip_text',
            [
                'label' => __( 'Tip Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Explanation and tip goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Type your tip here', 'roi-calculator-widget' ),
                'condition' => [
                    'show_forth_label_tip' => 'yes'
                ]
            ]
        );

        // Slider-Tip 3 Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'forth_tip_typography',
				'label' => __( 'Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .forth-tip',
			]
        );

        
        $this->end_controls_section();

        //Form-Label
        $this->start_controls_section(
            'fifth_label_settings',
            [
                'label' => __( 'Form-Label', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'more_options_fifth_label',
            [
                'label' => __( 'Label', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Form-Label Text
        $this->add_control(
            'fifth_label_text',
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
				'name' => 'fifth_label_typography',
				'label' => __( 'Typography', 'roi-calculator-widget' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .fifth-label',
			]
        );
        
        $this->add_control(
            'more_options_fifth_label_tip',
            [
                'label' => __( 'Tip', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Form-Label Tip
        $this->add_control(
            'show_fifth_label_tip',
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
            'fifth_tip_text',
            [
                'label' => __( 'Tip Text', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Explanation and tip goes here', 'roi-calculator-widget' ),
                'placeholder' => __( 'Type your tip here', 'roi-calculator-widget' ),
                'condition' => [
                    'show_fifth_label_tip' => 'yes'
                ]
            ]
        );

        // Form-Tip Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'fifth_tip_typography',
				'label' => __( 'Tip Typography', 'roi-calculator-widget' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .fifth-tip',
			]
        );

        
        $this->end_controls_section();

        //Form Settings
        $this->start_controls_section(
            'form_settings',
            [
                'label' => __( 'Form', 'roi-calculator-widget' ),
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

        // Firstname Placeholder Text
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

        // Firstname Placeholder Text
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

        // Firstname Placeholder Text
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
        //Basic Layout
        $this->start_controls_section(
            'layout_style_section',
            [
                'label' => __( 'Basic Layout', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'more_options_label_column',
            [
                'label' => __( 'Label-Column', 'roi-calculator-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Label Column Width
        $this->add_responsive_control(
            'label_column_width',
            [
                'label' => __( 'Width', 'roi-calculator-widget' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'description' => 'Default: ( Desktop: 40%, Tablet: 100% )',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .roi-left' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

            //Roi Left Padding
            $this->add_responsive_control(
                'label_column_padding',
                [
                    'label' => __( 'Padding', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'rem' ],
                    'description' => 'Default: ( 0px 60px 0px 60px )',
                    'default' => [
                        'top' => 0,
                        'right' => 60,
                        'bottom' => 0,
                        'left' => 60,
                        'isLinked' => 'false'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .roi-left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'label_column_text_align',
                [
                    'label' => __( 'Text Alignment', 'roi-calculator-widget' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'roi-calculator-widget' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'roi-calculator-widget' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'roi-calculator-widget' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'right',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .roi-left ' => 'text-align: {{VALUE}}',
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

        // Label Style Settings
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

            // Tip-Icon Height
            $this->add_responsive_control(
                'tip-icon_height',
                [
                    'label' => __( 'Tip-Icon Height', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'description' => 'Default: ( 30px )',
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip-trigger' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // Tip-Icon Width
            $this->add_responsive_control(
                'tip-icon_width',
                [
                    'label' => __( 'Tip-Icon Width', 'roi-calculator-widget' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'description' => 'Default: ( 30px )',
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .roi-tip-trigger' => 'width: {{SIZE}}{{UNIT}};',
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

        // Checklist Style Settings
        $this->start_controls_section(
            'checklist_style_section',
            [
                'label' => __( 'Checklist-Icon', 'roi-calculator-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
        

        // Checklist-Icon Width
        $this->add_responsive_control(
            'checklist_icon_width',
            [
                'label' => __( 'Checklist-Icon Width', 'roi-calculator-widget' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'description' => 'Default: ( 30px )',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .roi-checklist__icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Checklist-Icon Height
        $this->add_responsive_control(
            'checklist_icon_height',
            [
                'label' => __( 'Checklist-Icon Height', 'roi-calculator-widget' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'description' => 'Default: ( 30px )',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .roi-checklist__icon' => 'height: {{SIZE}}{{UNIT}};',
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
                'description' => 'Default: ( 7px 16px 0px 0px )',
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
                    'size' => 46,
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
                        <fieldset class="roi-row flex-row-space-between" style="order: <?php echo $settings[ 'row_order_first' ] ?>;">
                            <label class="roi-left">
                            <p class="roi-left__label first-label"><?php echo $settings[ 'first_label_text' ]; ?></p>
                            <?php if( $settings[ 'show_first_label_tip' ] == 'yes') : ?>
                                <span class="roi-tip-trigger flex-center"><p>?</p></span>
                                <span class="roi-tip first-tip">
                                    <p><?php echo $settings[ 'first_tip_text' ]; ?></p>
                                </span>
                            <?php endif; ?>
                            </label>
                            <div class="roi-right">
                                <div class="range__value" id="rangeV"></div>
                                <input id="range__input" type="range" min="0" max="10" step="1">
                            </div>
                        </fieldset>
                    
                        <fieldset class="roi-row flex-row-space-between" style="order: <?php echo $settings[ 'row_order_second' ] ?>;">
                            <label class="roi-left">
                            <p class="roi-left__label second-label"><?php echo $settings[ 'checklist_label_text' ]; ?></p>
                            <?php if( $settings[ 'show_checklist_label_tip' ] == 'yes') : ?>
                                <span class="roi-tip-trigger flex-center"><p>?</p></span>
                                <span class="roi-tip second-tip">
                                    <p><?php echo $settings[ 'checklist_tip_text' ]; ?></p>
                                </span>
                            <?php endif; ?>
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
                                            <span class="roi-checklist__labeltext">
                                                <?php echo $item[ 'checklist_text' ]; ?>
                                            </span>
                                        </li>
                                    </label>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </fieldset>
                        <fieldset class="roi-row flex-row-space-between" style="order: <?php echo $settings[ 'row_order_third' ] ?>;">
                            <label class="roi-left">
                                <p class="roi-left__label third-label"><?php echo $settings[ 'third_label_text' ]; ?></p>
                                <?php if( $settings[ 'show_third_label_tip' ] == 'yes') : ?>
                                    <span class="roi-tip-trigger flex-center"><p>?</p></span>
                                    <span class="roi-tip third-tip">
                                        <p><?php echo $settings[ 'third_tip_text' ]; ?></p>
                                    </span>
                                <?php endif; ?>
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
                        <fieldset class="roi-row flex-row-space-between" style="order: <?php echo $settings[ 'row_order_fourth' ] ?>;">
                            <label class="roi-left">
                                <p class="roi-left__label forth-label"><?php echo $settings[ 'forth_label_text' ]; ?></p>
                                <?php if( $settings[ 'show_forth_label_tip' ] == 'yes') : ?>
                                        <span class="roi-tip-trigger flex-center"><p>?</p></span>
                                        <span class="roi-tip forth-tip">
                                            <p><?php echo $settings[ 'forth_tip_text' ]; ?></p>
                                        </span>
                                    <?php endif; ?>
                            </label>
                            <div class="roi-right">
                                <div class="range__value" id="rangeV"></div>
                                <input id="range__input" type="range" min="0" max="10" step="1">
                            </div>
                        </fieldset>
                    
                        <fieldset class="roi-row flex-row-space-between" style="order: <?php echo $settings[ 'row_order_fifth' ] ?>;">
                            <label class="roi-left">
                                <p class="roi-left__label fifth-label"><?php echo $settings[ 'fifth_label_text' ]; ?></p>
                                    <?php if( $settings[ 'show_fifth_label_tip' ] == 'yes') : ?>
                                            <span class="roi-tip-trigger flex-center"><p>?</p></span>
                                            <span class="roi-tip fifth-tip">
                                                <p><?php echo $settings[ 'fifth_tip_text' ]; ?></p>
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
                        <fieldset class="roi-row flex-center" style="order: 6;">
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