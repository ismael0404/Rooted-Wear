<?php
/**
 * Fonctions utilitaires globales pour URBAN STYLE
 */

function e($string) {
    if ($string === null) return '';
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function formater_prix($montant) {
    if (!is_numeric($montant)) return '0 ' . DEVISE;
    return number_format($montant, 0, ',', ' ') . ' ' . DEVISE;
}

function rediriger($url) {
    $url = ltrim($url, '/');
    header('Location: ' . BASE_URL . '/' . $url);
    exit;
}

function message_flash($type, $message) {
    if (!isset($_SESSION['messages_flash'])) {
        $_SESSION['messages_flash'] = [];
    }
    $_SESSION['messages_flash'][] = ['type' => $type, 'message' => $message];
}

function afficher_messages_flash() {
    if (empty($_SESSION['messages_flash'])) {
        return '';
    }
    
    $html = '<div class="flash-messages-container" style="margin-bottom: 20px;">';
    foreach ($_SESSION['messages_flash'] as $msg) {
        $type = e($msg['type']);
        $message = e($msg['message']);
        
        $color = '#333';
        if ($type === 'success') $color = '#28a745';
        if ($type === 'error') $color = '#dc3545';
        if ($type === 'warning') $color = '#ffc107';
        
        $html .= "<div class=\"alert alert-{$type}\" style=\"color: white; background-color: {$color}; padding: 10px; margin-bottom: 5px; border-radius: 4px;\">{$message}</div>";
    }
    $html .= '</div>';
    
    unset($_SESSION['messages_flash']);
    
    return $html;
}

function generer_reference() {
    return 'CMD-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
}

/**
 * Retourne le chemin d'une image, ou un placeholder dynamique si elle n'existe pas
 */
function image_produit($chemin = null) {
    if ($chemin && !empty($chemin)) {
        return BASE_URL . '/' . ltrim($chemin, '/');
    }
    // Placeholder externe neutre et propre pour le design
    return 'https://via.placeholder.com/400x500/F5F5F5/111111?text=URBAN+STYLE';
}
