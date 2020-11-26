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
            // Slider Repeater
            $repeater = new \Elementor\Repeater();
            $repeater->add_control(
                'slider_title',
                [
                    'label' => __( 'Title', 'roi-elementor-widget' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'SLider Title #1', 'roi-elementor-widget' ),
                    'label_block' => true
                ]
            );
            $repeater->add_control(
                'slider_image',
                [
                    'label'   => __( 'Image', 'roi-elementor-widget' ),
                    'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ],
            );
            $this->add_control(
                'slider',
                [
                    'label' => __( 'Slider Items', 'roi-elementor-widget' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'slider_title' => __( 'Slider title #1', 'roi-elementor-widget' ),
                        ],
                    ],
                    'title_field' => '{{{ slider_title }}}',
                ]
            );
        $this->end_controls_section();

    }

    private function style_tab() {}

    protected function render() {
        $settings = $this->get_settings_for_display();
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
        <div class="owl-carousel owl-theme logo-carousel" <?php echo $this->get_render_attribute_string( 'roi_calculator_options' ); ?>>
            <?php foreach( $settings[ 'slider' ] as $slide ) : ?>
                <div class="item">
                    <img src="<?php echo esc_url( $slide[ 'slider_image' ][ 'url' ] ); ?>" alt="<?php esc_attr_e( $slide[ 'slider_title' ] ); ?>" />
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    protected function _content_template() {
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
        <div class="owl-carousel owl-theme logo-carousel" {{{ view.getRenderAttributeString( 'roi_calculator_options' ) }}}>
            <# _.each( settings.slider, function( slide ) { #>
            <div class="item">
                <img src="{{ slide.slider_image.url }}" alt="{{ slide.slider_title }}" />
            </div>
            <# } ) #>
        </div>
        <# } #>
        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new ROI_Calculator_Widget() );