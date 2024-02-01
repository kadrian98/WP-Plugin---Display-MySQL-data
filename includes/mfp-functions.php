<?php

class MainPlugin {
    public function run() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_delete_record', array($this, 'delete_record_callback'));
    }

    public function add_admin_menu() {
        add_menu_page(
            'Display MySQL data',
            'Klienci',
            'manage_options',
            'display-sql-data',
            array($this, 'display_settings_page'),
            'dashicons-welcome-view-site'
        );
    }

    public function delete_record_callback() {
        // Sprawdź nonce dla bezpieczeństwa
        check_ajax_referer('twoja_wtyczka_nonce', 'nonce');
    
        $recordId = isset($_POST['id']) ? intval($_POST['id']) : 0;

        $conn = new mysqli('localhost', 'root', '', 'formphp');

        if ($conn->connect_error) {
            wp_send_json_error('Błąd połączenia z bazą danych.');
            return;
        }
        $stmt = $conn->prepare("DELETE FROM formphp WHERE id = ?");
        $stmt->bind_param("i", $recordId);

        // Wykonanie zapytania
        if ($stmt->execute()) {
            wp_send_json_success('Rekord usunięty.');
        } else {
            wp_send_json_error('Błąd podczas usuwania rekordu.');
        }

        // Zamknięcie połączenia
        $stmt->close();
        $conn->close();
    } 
    
    public function display_settings_page() {
        include_once plugin_dir_path( __FILE__ ) . '../admin/views/admin-interface.php';    }


        public function enqueue_scripts() {
            wp_enqueue_style('twoja-nowa-wtyczka-css', plugin_dir_url(__FILE__) . '../admin/css/admin-style.css');
            wp_enqueue_script('twoja-nowa-wtyczka-js', plugin_dir_url(__FILE__) . '../admin/js/admin-script.js');
            wp_enqueue_script('jquery', get_template_directory_uri() . 'https://code.jquery.com/jquery-3.7.1.js', array(), false, false);

            wp_localize_script('twoja-nowa-wtyczka-js', 'ajax_object', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('twoja_wtyczka_nonce')
            ));
        }
}






