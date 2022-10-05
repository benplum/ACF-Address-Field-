<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class acf_field_address extends acf_field {

  public $sub_fields = array(
    'street' => 'Street',
    'street2' => 'Street 2',
    'street3' => 'Street 3',
    'city' => 'City',
    'state' => 'State',
    'zip' => 'ZIP',
    'country' => 'Country',
  );

  function __construct( $settings ) {
    $this->name = 'address';

    $this->label = __( 'Address', 'acf' );

    $this->category = 'content';

    $this->defaults = array(
      'sub_fields' => array(
        'street' => array( 'active' => 1, 'required' => 1 ),
        'street2' => array( 'active' => 0, 'required' => 0 ),
        'street3' => array( 'active' => 0, 'required' => 0 ),
        'city' => array( 'active' => 1, 'required' => 1 ),
        'state' => array( 'active' => 1, 'required' => 1 ),
        'zip' => array( 'active' => 1, 'required' => 1 ),
        'country' => array( 'active' => 0, 'required' => 0 ),
      ),
    );

    $this->l10n = array(
      // 'error'  => __( 'Error! Please enter a higher value', 'acf' ),
    );

    $this->settings = $settings;

    parent::__construct();
  }


  function render_field_settings( $field ) {

    foreach ( $this->sub_fields as $key => $label ) {

      acf_render_field_wrap( array(
        'label' => __($label,'acf'),
        'instructions' => '',
        'type' => 'true_false',
        'ui' => true,
        'ui_on_text' => 'On',
        'ui_off_text' => 'Off',
        // 'message' => 'Active',
        'name' => 'active',
        'prefix' => $field['prefix'] . '[sub_fields][' . $key . ']',
        'value' => $field['sub_fields'][ $key ]['active'],
        'wrapper' => array(
          'data-name' => $key,
          'class' => 'acf-field-setting-address',
        ),
      ), 'div' );

      acf_render_field_wrap( array(
        'label' => '',
        'instructions' => '',
        'type' => 'text',
        'name' => 'label',
        'prefix' => $field['prefix'] . '[sub_fields][' . $key . ']',
        'value' => $field['sub_fields'][ $key ]['label'],
        'prepend' => __('Label', 'acf'),
        'placeholder' => $label,
        'wrapper' => array(
          'data-append' => $key,
        ),
      ), 'div' );

      acf_render_field_wrap( array(
        'label' => '',
        'instructions' => '',
        'type' => 'true_false',
        'message' => 'Required',
        'name' => 'required',
        'prefix' => $field['prefix'] . '[sub_fields][' . $key . ']',
        'value' => $field['sub_fields'][ $key ]['required'],
        'wrapper' => array(
          'data-append' => $key,
        ),
      ), 'div' );

    }

?>
<style>
.post-type-acf-field-group .acf-field-setting-address {
  flex-wrap: wrap;
  max-width: 100%;
  margin-bottom: 15px;
}
.post-type-acf-field-group .acf-field-setting-address .acf-label {
  order: -1;
  flex: 0 0 100%;
  max-width: 100%;
  margin: 0 0 5px;
}
.post-type-acf-field-group .acf-field-setting-address ul.acf-hl {
  align-items: center;
}
.post-type-acf-field-group .acf-field-setting-address li:nth-child(1) {
  width: auto;
  margin-right: 10px;
}
.post-type-acf-field-group .acf-field-setting-address li:nth-child(2) {
  width: 400px;
}
.post-type-acf-field-group .acf-field-setting-address li:nth-child(3) {
  width: auto;
}
</style>
<?php

  }


  function render_field( $field ){
    $html = '';

    $field['value'] = wp_parse_args( $field['value'], array(
      'street' => '',
      'street2' => '',
      'street3' => '',
      'city' => '',
      'state' => '',
      'zip' => '',
      'country' => '',
    ) );

    $html .= '<div class="acf_address">';

    foreach ( $this->sub_fields as $key => $label ) {
      if ( $field['sub_fields'][ $key ]['active'] ) {
        $id = $field['id'] . '[' . $key . ']';
        $name = $field['name'] . '[' . $key . ']';

        if ( ! empty( $field['sub_fields'][ $key ]['label'] ) ) {
          $label = $field['sub_fields'][ $key ]['label'];
        }

        if ( $field['sub_fields'][ $key ]['required'] ) {
          $label .= '<span class="required">*</span>';
        }

        $input_attrs  = array(
          'type' => 'text',
          'id' => $id,
          'name' => $name,
          'value' => $field['value'][ $key ],
          'required' => $field['sub_fields'][ $key ]['required'],
          // 'placeholder' => 'Street',
        );

        $html .= '<div class="address_wrap address_' . $key . '">';
        $html .= acf_get_text_input( acf_filter_attrs( $input_attrs ) );
        $html .= '<label class="address_sublabel" for="' . $id . '">' . $label . '</label>';
        $html .= '</div>';
      }
    }

    $html .= '</div>';

    echo $html;
  }


  function input_admin_enqueue_scripts() {
    $url = $this->settings['url'];
    $version = $this->settings['version'];

    // wp_register_script( 'acf_address-js', $url . 'assets/js/input.js', array( 'acf-input' ), $version );
    // wp_enqueue_script( 'acf_address-js' );

    wp_register_style( 'acf_address-css', $url . 'assets/css/input.css', array( 'acf-input' ), $version );
    wp_enqueue_style( 'acf_address-css' );
  }

}

new acf_field_address( $this->settings );
