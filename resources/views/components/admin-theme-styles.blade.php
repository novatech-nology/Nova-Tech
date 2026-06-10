{{-- Comentario Nova Tech: Arquivo resources/views/components/admin-theme-styles.blade.php. Origem: Componentes visuais Blade. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<style>
    body.admin-theme {
        background:
            radial-gradient(circle at 18% 0%, rgba(126, 10, 133, .18), transparent 34rem),
            radial-gradient(circle at 92% 12%, rgba(14, 165, 233, .08), transparent 30rem),
            #09090b !important;
        color: #f4f4f5 !important;
        font-family: 'Inter', sans-serif;
    }

    .admin-theme h1,
    .admin-theme h2,
    .admin-theme h3 {
        font-family: 'Instrument Sans', 'Inter', sans-serif;
        letter-spacing: 0;
    }

    .admin-theme aside {
        background: rgba(17, 17, 19, .96) !important;
        border-color: #27272a !important;
        box-shadow: 24px 0 70px rgba(0, 0, 0, .24);
    }

    .admin-theme aside img {
        filter: drop-shadow(0 10px 24px rgba(126, 10, 133, .18));
    }

    .admin-theme .sidebar-item {
        border-left-color: transparent !important;
        color: #a1a1aa !important;
        border-radius: 0 10px 10px 0;
        margin: 0 14px 6px 0;
    }

    .admin-theme .sidebar-item.active,
    .admin-theme .sidebar-item:hover {
        color: #ffffff !important;
        background: rgba(126, 10, 133, .16) !important;
        border-left-color: #7e0a85 !important;
    }

    .admin-theme aside .border-t {
        border-color: #27272a !important;
    }

    .admin-theme main {
        min-height: 100vh;
    }

    .admin-theme header h1,
    .admin-theme .text-zinc-900,
    .admin-theme .text-zinc-800,
    .admin-theme .text-zinc-700 {
        color: #f4f4f5 !important;
    }

    .admin-theme .text-zinc-600,
    .admin-theme .text-zinc-500,
    .admin-theme .text-zinc-400 {
        color: #a1a1aa !important;
    }

    .admin-theme .bg-white,
    .admin-theme .stat-card {
        background: rgba(18, 18, 20, .92) !important;
        border-color: #27272a !important;
        box-shadow: 0 24px 60px rgba(0, 0, 0, .26) !important;
    }

    .admin-theme .bg-zinc-50,
    .admin-theme .hover\:bg-zinc-50:hover,
    .admin-theme .bg-zinc-100,
    .admin-theme .hover\:bg-zinc-100:hover {
        background: rgba(255, 255, 255, .045) !important;
    }

    .admin-theme .border-zinc-100,
    .admin-theme .border-zinc-200,
    .admin-theme .border-zinc-800,
    .admin-theme .divide-zinc-50 > :not([hidden]) ~ :not([hidden]) {
        border-color: #27272a !important;
    }

    .admin-theme table thead tr {
        background: rgba(255, 255, 255, .035) !important;
        color: #a1a1aa !important;
    }

    .admin-theme table tbody tr:hover {
        background: rgba(126, 10, 133, .08) !important;
    }

    .admin-theme .status-badge {
        border-color: rgba(255, 255, 255, .12) !important;
    }

    .admin-theme .stat-icon {
        background: rgba(126, 10, 133, .14) !important;
        border: 1px solid rgba(165, 44, 173, .28);
        color: #d400b8;
        font-size: 12px !important;
        font-weight: 900;
    }

    .admin-theme .status-confirmado,
    .admin-theme .status-entregue {
        background: rgba(34, 197, 94, .1) !important;
        color: #86efac !important;
    }

    .admin-theme .status-pendente {
        background: rgba(245, 158, 11, .1) !important;
        color: #fde68a !important;
    }

    .admin-theme .status-enviado {
        background: rgba(59, 130, 246, .1) !important;
        color: #93c5fd !important;
    }

    .admin-theme .status-cancelado {
        background: rgba(239, 68, 68, .1) !important;
        color: #fca5a5 !important;
    }

    .admin-theme input,
    .admin-theme select,
    .admin-theme textarea {
        background: #0c0c0f !important;
        border-color: #27272a !important;
        color: #ffffff !important;
        box-shadow: none !important;
    }

    .admin-theme input::placeholder,
    .admin-theme textarea::placeholder {
        color: #52525b !important;
    }

    .admin-theme input:focus,
    .admin-theme select:focus,
    .admin-theme textarea:focus {
        border-color: #a52cad !important;
        box-shadow: 0 0 0 4px rgba(126, 10, 133, .14) !important;
        outline: none !important;
    }

    .admin-theme button[type="submit"],
    .admin-theme a[href*="create"],
    .admin-theme a[href*="editar"],
    .admin-theme a[href*="produtos"] {
        transition: .2s ease;
    }

    .admin-theme main > header {
        border: 1px solid #27272a;
        border-radius: 14px;
        background:
            linear-gradient(135deg, rgba(126, 10, 133, .14), transparent 44%),
            rgba(18, 18, 20, .78);
        padding: 22px 24px;
    }

    .admin-theme .shadow-sm,
    .admin-theme .shadow-lg {
        box-shadow: 0 24px 60px rgba(0, 0, 0, .25) !important;
    }

    .admin-theme .rounded-xl,
    .admin-theme .rounded-2xl,
    .admin-theme .rounded-lg {
        border-radius: 10px !important;
    }

    .admin-theme .bg-zinc-900,
    .admin-theme button.bg-zinc-900 {
        background: linear-gradient(135deg, #7e0a85, #5c0760) !important;
        color: #ffffff !important;
    }

    .admin-theme .hover\:bg-zinc-800:hover {
        background: #5c0760 !important;
    }

    .admin-theme .bg-green-50 {
        background: rgba(34, 197, 94, .1) !important;
        border-color: rgba(34, 197, 94, .28) !important;
        color: #bbf7d0 !important;
    }

    .admin-theme .text-emerald-700 {
        color: #86efac !important;
    }

    .admin-theme .text-blue-700 {
        color: #93c5fd !important;
    }

    .admin-theme .hover\:text-red-500:hover,
    .admin-theme .text-red-500 {
        color: #fca5a5 !important;
    }

    .admin-theme .bg-red-50 {
        background: rgba(239, 68, 68, .1) !important;
        border-color: rgba(239, 68, 68, .28) !important;
        color: #fecaca !important;
    }

    .admin-theme .product-list::-webkit-scrollbar {
        width: 5px;
    }

    .admin-theme .product-list::-webkit-scrollbar-thumb {
        background: #7e0a85;
        border-radius: 999px;
    }

    @media (max-width: 900px) {
        body.admin-theme {
            display: block !important;
        }

        .admin-theme aside {
            position: static !important;
            width: 100% !important;
            height: auto !important;
        }

        .admin-theme aside nav {
            display: flex;
            overflow-x: auto;
            padding-bottom: 12px;
        }

        .admin-theme .sidebar-item {
            min-width: max-content;
            border-left: 0 !important;
            border-bottom: 3px solid transparent;
            border-radius: 8px;
            margin: 0 4px;
        }

        .admin-theme .sidebar-item.active,
        .admin-theme .sidebar-item:hover {
            border-bottom-color: #7e0a85 !important;
        }

        .admin-theme main {
            margin-left: 0 !important;
            padding: 20px !important;
        }
    }
</style>
