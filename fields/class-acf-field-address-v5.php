<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class acf_field_address extends acf_field {

  function __construct( $settings ) {
    $this->name = 'address';

    $this->label = __( 'Address', 'acf' );

    $this->category = 'content';

    $this->defaults = array(
      'display_street' => true,
      'display_street2' => false,
      'display_street3' => false,
      'display_city' => true,
      'display_state' => true,
      'display_zip' => true,
      'display_country' => false,
    );

    $this->l10n = array(
      // 'error'  => __( 'Error! Please enter a higher value', 'acf' ),
    );

    $this->settings = $settings;

    parent::__construct();
  }


  function render_field_settings( $field ) {

    acf_render_field_setting( $field, array(
      'label' => __( 'Street', 'acf' ),
      // 'instructions'  => __( 'Customise the input font size', 'acf' ),
      'type' => 'true_false',
      'name' => 'display_street',
    ));

    acf_render_field_setting( $field, array(
      'label' => __( 'Street 2', 'acf' ),
      // 'instructions'  => __( 'Customise the input font size', 'acf' ),
      'type' => 'true_false',
      'name' => 'display_street2',
    ));

    acf_render_field_setting( $field, array(
      'label' => __( 'Street 3', 'acf' ),
      // 'instructions'  => __( 'Customise the input font size', 'acf' ),
      'type' => 'true_false',
      'name' => 'display_street3',
    ));

    acf_render_field_setting( $field, array(
      'label' => __( 'City', 'acf' ),
      // 'instructions'  => __( 'Customise the input font size', 'acf' ),
      'type' => 'true_false',
      'name' => 'display_city',
    ));

    acf_render_field_setting( $field, array(
      'label' => __( 'State', 'acf' ),
      // 'instructions'  => __( 'Customise the input font size', 'acf' ),
      'type' => 'true_false',
      'name' => 'display_state',
    ));

    acf_render_field_setting( $field, array(
      'label' => __( 'ZIP', 'acf' ),
      // 'instructions'  => __( 'Customise the input font size', 'acf' ),
      'type' => 'true_false',
      'name' => 'display_zip',
    ));

    acf_render_field_setting( $field, array(
      'label' => __( 'Country', 'acf' ),
      // 'instructions'  => __( 'Customise the input font size', 'acf' ),
      'type' => 'true_false',
      'name' => 'display_country',
    ));

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

    if ( $field['display_street'] ) {
       $input_attrs  = array(
        'type' => 'text',
        'id' => $field['id'] . '[street]',
        'name' => $field['name'] . '[street]',
        'value' => $field['value']['street'],
        // 'placeholder' => 'Street',
      );
      $html .= '<div class="address_wrap address_street">' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '<span class="address_sublabel">Street</span></div>';
    }

    if ( $field['display_street2'] ) {
       $input_attrs  = array(
        'type' => 'text',
        'id' => $field['id'] . '[street2]',
        'name' => $field['name'] . '[street2]',
        'value' => $field['value']['street2'],
        // 'placeholder' => 'Street 2',
      );
      $html .= '<div class="address_wrap address_street2">' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '<span class="address_sublabel">Street 2</span></div>';
    }

    if ( $field['display_street3'] ) {
       $input_attrs  = array(
        'type' => 'text',
        'id' => $field['id'] . '[street3]',
        'name' => $field['name'] . '[street3]',
        'value' => $field['value']['street3'],
        // 'placeholder' => 'Street 3',
      );
      $html .= '<div class="address_wrap address_street3">' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '<span class="address_sublabel">Street 3</span></div>';
    }

    if ( $field['display_city'] ) {
       $input_attrs  = array(
        'type' => 'text',
        'id' => $field['id'] . '[city]',
        'name' => $field['name'] . '[city]',
        'value' => $field['value']['city'],
        // 'placeholder' => 'City',
      );
      $html .= '<div class="address_wrap address_city">' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '<span class="address_sublabel">City</span></div>';
    }

    if ( $field['display_state'] ) {
       $input_attrs  = array(
        'type' => 'text',
        'id' => $field['id'] . '[state]',
        'name' => $field['name'] . '[state]',
        'value' => $field['value']['state'],
        // 'placeholder' => 'State',
      );
      $html .= '<div class="address_wrap address_state">' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '
      <span class="address_sublabel">State</span></div>';
    }

    if ( $field['display_zip'] ) {
       $input_attrs  = array(
        'type' => 'text',
        'id' => $field['id'] . '[zip]',
        'name' => $field['name'] . '[zip]',
        'value' => $field['value']['zip'],
        // 'placeholder' => 'ZIP',
      );
      $html .= '<div class="address_wrap address_zip">' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '
      <span class="address_sublabel">ZIP</span></div>';
    }

    if ( $field['display_country'] ) {
       $input_attrs  = array(
        'type' => 'text',
        'id' => $field['id'] . '[country]',
        'name' => $field['name'] . '[country]',
        'value' => $field['value']['country'],
        // 'placeholder' => 'Country',
      );
      $html .= '<div class="address_wrap address_country">' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '
      <span class="address_sublabel">Country</span></div>';
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
