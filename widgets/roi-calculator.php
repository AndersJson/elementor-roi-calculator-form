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

    }

    private function style_tab() {}

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
        <?php
    }

    protected function _content_template() {
        /*
        ?>
        <#
            view.addRenderAttribute(
                'roi_calculator_options',
                {
                    'id': 'roi-calculator-id',
                    'data-loop': settings.loop,
                    'data-dots': settings.dots,
                    'data-navs': settings.navs,
                    'data-margin': settings.margin
                }
            );
        #>
        <# if( settings.slider.length ) { #>
        <div>
            <h1>hello _content_temlate()</h1>
        </div>
        <# } #>
        <?php
        */
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new ROI_Calculator_Widget() );