<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Ulam Sari Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    :root {
      --color-bg:        #FDFBF7;
      --color-sidebar:   #3E2723;
      --color-card:      #FFFFFF;
      --color-card-hover:#FEFCF8;
      --color-border:    rgba(62,39,35,0.12);
      --color-primary:   #3E2723;
      --color-primary-h: #4E342E;
      --color-secondary: #A0522D;
      --color-tertiary:  #2D3E2D;
      --color-accent:    #A0522D;
      --color-text:      #3E2723;
      --color-muted:     #8D6E63;
      --color-green:     #2E7D32;
      --color-red:       #C62828;
      --color-orange:    #E65100;
      --color-cream:     #FDFBF7;
      --shadow-card:     0 1px 3px rgba(62,39,35,0.08), 0 1px 2px rgba(62,39,35,0.06);
      --shadow-card-hover: 0 4px 12px rgba(62,39,35,0.10);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif;
      background: var(--color-bg);
      color: var(--color-text);
      min-height: 100vh;
      overflow-x: hidden;
    }
    #app { position: relative; z-index: 1; display: flex; min-height: 100vh; }

    /* SIDEBAR GÇö stays dark for contrast */
    aside {
      width: 220px; flex-shrink: 0;
      background: var(--color-sidebar);
      display: flex; flex-direction: column;
    }
    .brand { display: flex; align-items: center; gap: 10px; padding: 20px 20px 16px; border-bottom: 1px solid rgba(255,255,255,0.1); }
    .brand-logo {
      width: 36px; height: 36px; border-radius: 10px;
      background: var(--color-secondary);
      display: flex; align-items: center; justify-content: center;
    }
    .brand-logo svg { width: 20px; height: 20px; color: #fff; }
    .brand-name { font-family: 'EB Garamond', serif; font-size: 16px; font-weight: 700; color: #FDFBF7; letter-spacing: 0.3px; }

    .user-card {
      display: flex; align-items: center; gap: 10px;
      padding: 14px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .avatar {
      width: 36px; height: 36px; border-radius: 50%;
      background: var(--color-secondary);
      display: flex; align-items: center; justify-content: center;
      font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
    }
    .user-name { font-size: 13px; font-weight: 600; color: #FDFBF7; }
    .user-role { font-size: 11px; color: rgba(253,251,247,0.55); margin-top: 1px; }

    nav { flex: 1; padding: 10px 0; }
    .nav-item {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 20px; font-size: 13px; font-weight: 500;
      color: rgba(253,251,247,0.55); cursor: pointer;
      border-right: 3px solid transparent;
      transition: all 150ms ease; border: none; background: none; width: 100%; text-align: left;
    }
    .nav-item .nav-icon { width: 24px; height: 24px; border-radius: 6px; object-fit: cover; flex-shrink: 0; }
    .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
    .nav-item:hover { color: #FDFBF7; background: rgba(255,255,255,0.08); }
    .nav-item.active {
      color: #FDFBF7;
      background: rgba(160,82,45,0.25);
      border-right: 3px solid var(--color-secondary);
    }

    .sidebar-bottom { padding: 14px 16px; border-top: 1px solid rgba(255,255,255,0.1); }
    .btn-new {
      display: flex; align-items: center; justify-content: center; gap: 8px;
      width: 100%; padding: 10px 16px; border-radius: 10px; border: none; cursor: pointer;
      background: var(--color-secondary);
      color: #fff; font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif;
      transition: all 150ms ease;
    }
    .btn-new:hover { background: #8B4513; transform: translateY(-1px); }
    .btn-new svg { width: 15px; height: 15px; }
    .nav-footer { display: flex; flex-direction: column; gap: 2px; margin-top: 10px; }
    .nav-footer .nav-item { border-right: none !important; }
    .nav-logout { color: #EF9A9A !important; }
    .nav-logout:hover { background: rgba(198,40,40,0.15) !important; color: #EF5350 !important; }

    /* MAIN */
    header {
      display: flex; align-items: center; justify-content: space-between;
      padding: 14px 32px;
      background: #FFFFFF;
      border-bottom: 1px solid var(--color-border);
    }
    .header-title { font-size: 14px; color: var(--color-muted); }
    .header-title span { color: var(--color-secondary); font-weight: 600; }
    .btn-logout {
      display: flex; align-items: center; gap: 6px;
      padding: 7px 14px; border-radius: 8px; border: 1px solid var(--color-border);
      background: #fff; color: var(--color-muted);
      font-size: 12px; font-weight: 500; cursor: pointer; font-family: 'Inter', sans-serif;
      transition: all 150ms ease;
    }
    .btn-logout:hover { color: var(--color-red); border-color: rgba(198,40,40,0.3); background: rgba(198,40,40,0.04); }
    .btn-logout svg { width: 14px; height: 14px; }

    .page-body { flex: 1; overflow-y: auto; padding: 28px 32px; }
    .page-body::-webkit-scrollbar { width: 4px; }
    .page-body::-webkit-scrollbar-thumb { background: rgba(62,39,35,0.15); border-radius: 4px; }

    /* CARDS */
    .glass-card {
      background: var(--color-card);
      border: 1px solid var(--color-border);
      border-radius: 16px;
      box-shadow: var(--shadow-card);
    }
    .glass-card:hover { box-shadow: var(--shadow-card-hover); }

    /* PAGE HEADER */
    .page-h1 { font-family: 'EB Garamond', serif; font-size: 28px; font-weight: 700; margin-bottom: 4px; color: var(--color-primary); }
    .page-sub { font-size: 13px; color: var(--color-muted); margin-bottom: 24px; }

    /* STAT CARDS */
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px; }
    .stat-card {
      padding: 20px 24px;
      background: var(--color-card);
      border: 1px solid var(--color-border);
      border-radius: 16px;
      box-shadow: var(--shadow-card);
      position: relative; overflow: hidden;
      transition: box-shadow 150ms ease, transform 150ms ease;
      cursor: default;
    }
    .stat-card:hover { box-shadow: var(--shadow-card-hover); transform: translateY(-2px); }
    .stat-badge {
      display: inline-flex; align-items: center; gap: 4px;
      font-size: 10px; font-weight: 600; padding: 3px 8px; border-radius: 20px;
      letter-spacing: 0.3px; margin-bottom: 14px;
    }
    .badge-green { background: rgba(46,125,50,0.08); color: var(--color-green); border: 1px solid rgba(46,125,50,0.2); }
    .badge-orange { background: rgba(230,81,0,0.08); color: var(--color-orange); border: 1px solid rgba(230,81,0,0.2); }
    .badge-muted { background: rgba(62,39,35,0.05); color: var(--color-muted); border: 1px solid var(--color-border); }
    .stat-icon {
      width: 40px; height: 40px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 14px;
    }
    .stat-icon svg { width: 20px; height: 20px; }
    .stat-icon-orange { background: rgba(160,82,45,0.1); color: var(--color-secondary); }
    .stat-icon-amber { background: rgba(230,81,0,0.1); color: var(--color-orange); }
    .stat-icon-muted { background: rgba(62,39,35,0.06); color: var(--color-muted); }
    .stat-number { font-family: 'EB Garamond', serif; font-size: 36px; font-weight: 700; line-height: 1; margin-bottom: 4px; color: var(--color-primary); }
    .stat-label { font-size: 12px; color: var(--color-muted); font-weight: 500; }

    /* ACTIVITY */
    .activity-card { padding: 22px 24px; }
    .activity-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .activity-title { font-size: 15px; font-weight: 600; color: var(--color-primary); }
    .btn-view-all {
      font-size: 12px; color: var(--color-secondary); background: none; border: none;
      cursor: pointer; font-family: 'Inter', sans-serif; font-weight: 500;
      transition: opacity 150ms ease;
    }
    .btn-view-all:hover { opacity: 0.75; }
    .activity-item { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; padding: 14px 0; border-bottom: 1px solid var(--color-border); }
    .activity-item:last-child { border-bottom: none; }
    .activity-dot { width: 7px; height: 7px; border-radius: 50%; margin-top: 5px; flex-shrink: 0; }
    .dot-orange { background: var(--color-orange); }
    .dot-muted { background: var(--color-muted); }
    .activity-text { font-size: 13px; font-weight: 500; margin-bottom: 2px; }
    .activity-sub { font-size: 11px; color: var(--color-muted); }
    .activity-time { font-size: 11px; color: var(--color-muted); white-space: nowrap; }

    /* MENU TABLE */
    .menu-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; }
    .cat-tabs { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 16px; }
    .cat-tab {
      padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 500;
      border: 1px solid var(--color-border); background: #fff;
      color: var(--color-muted); cursor: pointer; transition: all 150ms ease;
      font-family: 'Inter', sans-serif;
    }
    .cat-tab:hover { color: var(--color-text); border-color: rgba(62,39,35,0.25); }
    .cat-tab.active { background: var(--color-primary); border-color: var(--color-primary); color: #fff; }
    .sort-select {
      background: #fff; border: 1px solid var(--color-border);
      color: var(--color-text); padding: 6px 12px; border-radius: 8px;
      font-size: 12px; font-family: 'Inter', sans-serif; cursor: pointer; outline: none;
    }

    .btn-primary {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 9px 18px; border-radius: 10px; border: none; cursor: pointer;
      background: var(--color-primary);
      color: #fff; font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif;
      transition: all 150ms ease;
      box-shadow: 0 2px 8px rgba(62,39,35,0.2);
    }
    .btn-primary:hover { background: var(--color-primary-h); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(62,39,35,0.25); }
    .btn-primary svg { width: 15px; height: 15px; }

    table { width: 100%; border-collapse: collapse; }
    thead tr { border-bottom: 1px solid var(--color-border); }
    th { text-align: left; padding: 10px 16px; font-size: 11px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.8px; }
    td { padding: 14px 16px; font-size: 13px; border-bottom: 1px solid rgba(62,39,35,0.06); }
    tbody tr { transition: background 100ms ease; }
    tbody tr:hover { background: rgba(62,39,35,0.02); }
    tbody tr:last-child td { border-bottom: none; }

    .menu-thumb {
      width: 38px; height: 38px; border-radius: 8px;
      background: rgba(62,39,35,0.04); display: flex; align-items: center;
      justify-content: center; font-size: 18px; flex-shrink: 0;
      border: 1px solid var(--color-border); overflow: hidden;
    }
    .menu-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .menu-name { font-weight: 600; font-size: 13px; }
    .menu-desc { font-size: 11px; color: var(--color-muted); margin-top: 2px; }
    .cat-pill {
      display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 500;
      background: rgba(62,39,35,0.05); border: 1px solid var(--color-border); color: var(--color-muted);
    }
    .price { font-size: 13px; font-weight: 600; color: var(--color-secondary); }
    .status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; margin-right: 5px; }
    .status-ok { color: var(--color-green); }
    .status-ok .status-dot { background: var(--color-green); }
    .status-bad { color: var(--color-red); }
    .status-bad .status-dot { background: var(--color-red); }
    .action-btn {
      width: 30px; height: 30px; border-radius: 7px; border: 1px solid var(--color-border);
      background: #fff; color: var(--color-muted);
      display: inline-flex; align-items: center; justify-content: center; cursor: pointer;
      transition: all 150ms ease; font-family: 'Inter', sans-serif;
    }
    .action-btn svg { width: 14px; height: 14px; }
    .action-btn:hover { border-color: rgba(62,39,35,0.25); color: var(--color-text); background: rgba(62,39,35,0.03); }
    .action-btn.del:hover { border-color: rgba(198,40,40,0.3); color: var(--color-red); background: rgba(198,40,40,0.04); }
    .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 14px 16px; border-top: 1px solid var(--color-border); }
    .table-info { font-size: 12px; color: var(--color-muted); }
    .pagination { display: flex; gap: 4px; }
    .pg-btn {
      width: 30px; height: 30px; border-radius: 7px; border: 1px solid var(--color-border);
      background: #fff; color: var(--color-muted);
      display: inline-flex; align-items: center; justify-content: center; cursor: pointer;
      font-size: 12px; font-weight: 600; transition: all 150ms ease;
    }
    .pg-btn:hover { border-color: rgba(62,39,35,0.25); color: var(--color-text); }
    .pg-btn.active { background: var(--color-primary); border-color: var(--color-primary); color: #fff; }
    .pg-btn:disabled { opacity: 0.3; cursor: default; }

    /* RESERVATION CARDS */
    .rsv-filters { display: flex; gap: 8px; }
    .filter-select {
      background: #fff; border: 1px solid var(--color-border);
      color: var(--color-text); padding: 8px 14px; border-radius: 10px;
      font-size: 12px; font-family: 'Inter', sans-serif; cursor: pointer; outline: none;
    }
    .rsv-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
    .rsv-card {
      padding: 20px;
      background: var(--color-card);
      border: 1px solid var(--color-border);
      border-radius: 16px;
      box-shadow: var(--shadow-card);
      position: relative; overflow: hidden;
      transition: box-shadow 150ms ease, transform 150ms ease;
    }
    .rsv-card:hover { box-shadow: var(--shadow-card-hover); transform: translateY(-2px); }
    .rsv-card-menunggu { border-top: 2px solid var(--color-orange); }
    .rsv-card-dikonfirmasi { border-top: 2px solid var(--color-green); }
    .rsv-card-ditolak { border-top: 2px solid var(--color-red); }
    .rsv-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; }
    .rsv-badge { font-size: 10px; font-weight: 600; padding: 3px 8px; border-radius: 20px; }
    .rsv-badge-menunggu { background: rgba(230,81,0,0.08); color: var(--color-orange); border: 1px solid rgba(230,81,0,0.2); }
    .rsv-badge-dikonfirmasi { background: rgba(46,125,50,0.08); color: var(--color-green); border: 1px solid rgba(46,125,50,0.2); }
    .rsv-badge-ditolak { background: rgba(198,40,40,0.08); color: var(--color-red); border: 1px solid rgba(198,40,40,0.2); }
    .rsv-code { font-size: 14px; font-weight: 700; color: var(--color-secondary); }
    .rsv-name { font-family: 'EB Garamond', serif; font-size: 18px; font-weight: 700; margin-bottom: 12px; color: var(--color-primary); }
    .rsv-detail { font-size: 12px; color: var(--color-muted); display: flex; align-items: center; gap: 7px; margin-bottom: 7px; }
    .rsv-detail svg { width: 13px; height: 13px; flex-shrink: 0; }
    .rsv-actions { display: flex; gap: 8px; margin-top: 16px; }
    .btn-confirm {
      flex: 1; padding: 9px; border-radius: 9px; border: none; cursor: pointer;
      background: var(--color-primary);
      color: #fff; font-size: 12px; font-weight: 600; font-family: 'Inter', sans-serif;
      transition: all 150ms ease;
    }
    .btn-confirm:hover { background: var(--color-primary-h); transform: translateY(-1px); }
    .btn-outline {
      flex: 1; padding: 9px; border-radius: 9px;
      border: 1px solid var(--color-border); background: #fff;
      color: var(--color-text); font-size: 12px; font-weight: 600; font-family: 'Inter', sans-serif;
      cursor: pointer; transition: all 150ms ease;
    }
    .btn-outline:hover { border-color: rgba(62,39,35,0.25); background: rgba(62,39,35,0.02); }
    .btn-detail {
      width: 100%; padding: 9px; border-radius: 9px;
      border: 1px solid var(--color-border); background: #fff;
      color: var(--color-muted); font-size: 12px; font-weight: 500; font-family: 'Inter', sans-serif;
      cursor: pointer; transition: all 150ms ease; display: flex; align-items: center; justify-content: center; gap: 6px;
    }
    .btn-detail svg { width: 13px; height: 13px; }
    .btn-detail:hover { color: var(--color-text); border-color: rgba(62,39,35,0.25); }

    /* LOGIN */
    #page-login {
      min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center;
      background: var(--color-bg);
      position: relative;
    }
    .login-wrap { position: relative; z-index: 1; width: 100%; max-width: 400px; }
    .login-logo-card {
      background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 20px 20px 0 0;
      padding: 36px 40px 24px; text-align: center;
      box-shadow: 0 -2px 10px rgba(62,39,35,0.04);
      border-bottom: none;
    }
    .login-logo-icon {
      width: 64px; height: 64px; border-radius: 18px; margin: 0 auto 18px;
      background: var(--color-primary);
      display: flex; align-items: center; justify-content: center;
    }
    .login-logo-icon svg { width: 34px; height: 34px; color: #fff; }
    .login-title { font-family: 'EB Garamond', serif; font-size: 24px; font-weight: 700; margin-bottom: 4px; color: var(--color-primary); }
    .login-sub { font-size: 13px; color: var(--color-muted); }
    .login-form-card {
      background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 0 0 20px 20px;
      padding: 28px 40px 36px;
      box-shadow: 0 4px 16px rgba(62,39,35,0.06);
    }
    .login-error {
      background: rgba(198,40,40,0.06); border: 1px solid rgba(198,40,40,0.2);
      color: var(--color-red); font-size: 13px; padding: 10px 14px; border-radius: 9px; margin-bottom: 20px;
      display: none;
    }
    .field-label { font-size: 12px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.7px; margin-bottom: 8px; display: flex; justify-content: space-between; align-items: center; }
    .field-link { color: var(--color-secondary); font-size: 11px; text-transform: none; letter-spacing: 0; cursor: pointer; }
    .field-wrap { display: flex; align-items: center; gap: 10px; background: rgba(62,39,35,0.03); border: 1px solid var(--color-border); border-radius: 10px; padding: 11px 14px; margin-bottom: 18px; transition: border-color 150ms ease; }
    .field-wrap:focus-within { border-color: var(--color-secondary); }
    .field-wrap svg { width: 16px; height: 16px; color: var(--color-muted); flex-shrink: 0; }
    .field-wrap input { flex: 1; background: none; border: none; outline: none; color: var(--color-text); font-size: 14px; font-family: 'Inter', sans-serif; }
    .field-wrap input::placeholder { color: var(--color-muted); }
    .btn-toggle-pwd { background: none; border: none; cursor: pointer; color: var(--color-muted); padding: 0; display: flex; align-items: center; }
    .btn-toggle-pwd svg { width: 16px; height: 16px; }
    .btn-login {
      width: 100%; padding: 13px; border-radius: 12px; border: none; cursor: pointer;
      background: var(--color-primary);
      color: #fff; font-size: 15px; font-weight: 700; font-family: 'Inter', sans-serif;
      transition: all 150ms ease; display: flex; align-items: center; justify-content: center; gap: 8px;
      box-shadow: 0 4px 12px rgba(62,39,35,0.2);
    }
    .btn-login:hover { background: var(--color-primary-h); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(62,39,35,0.25); }
    .btn-login svg { width: 18px; height: 18px; }
    .login-footer { text-align: center; font-size: 12px; color: var(--color-muted); margin-top: 28px; }

    /* MODAL */
    .modal-backdrop { position: fixed; inset: 0; background: rgba(62,39,35,0.4); backdrop-filter: blur(4px); z-index: 100; display: none; align-items: center; justify-content: center; }
    .modal-backdrop.open { display: flex; }
    .modal {
      background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 20px;
      padding: 28px; width: 100%; max-width: 440px; position: relative;
      box-shadow: 0 24px 64px rgba(62,39,35,0.15);
    }
    .modal-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
    .modal-title { font-family: 'EB Garamond', serif; font-size: 18px; font-weight: 700; color: var(--color-primary); }
    .btn-close { background: none; border: none; cursor: pointer; color: var(--color-muted); padding: 4px; border-radius: 6px; transition: color 150ms ease; }
    .btn-close:hover { color: var(--color-text); }
    .btn-close svg { width: 18px; height: 18px; }
    .modal-field { margin-bottom: 16px; }
    .modal-label { font-size: 11px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.7px; margin-bottom: 7px; display: block; }
    .modal-input {
      width: 100%; background: rgba(62,39,35,0.03); border: 1px solid var(--color-border);
      border-radius: 9px; padding: 10px 13px; color: var(--color-text);
      font-size: 13px; font-family: 'Inter', sans-serif; outline: none; transition: border-color 150ms ease;
    }
    .modal-input:focus { border-color: var(--color-secondary); }
    .modal-grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .modal-footer { display: flex; gap: 10px; justify-content: flex-end; margin-top: 22px; }
    .btn-cancel {
      padding: 9px 18px; border-radius: 9px; border: 1px solid var(--color-border);
      background: #fff; color: var(--color-muted); font-size: 13px; font-weight: 500;
      font-family: 'Inter', sans-serif; cursor: pointer; transition: all 150ms ease;
    }
    .btn-cancel:hover { color: var(--color-text); border-color: rgba(62,39,35,0.25); }
    .btn-save {
      padding: 9px 20px; border-radius: 9px; border: none;
      background: var(--color-primary);
      color: #fff; font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif;
      cursor: pointer; transition: all 150ms ease;
    }
    .btn-save:hover { background: var(--color-primary-h); transform: translateY(-1px); }

    /* IMAGE UPLOAD */
    .img-upload-area {
      border: 2px dashed var(--color-border); border-radius: 12px;
      padding: 16px; text-align: center; cursor: pointer;
      transition: border-color 150ms ease; position: relative;
      min-height: 80px; display: flex; align-items: center; justify-content: center; gap: 12px;
    }
    .img-upload-area:hover { border-color: var(--color-secondary); }
    .img-upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
    .img-upload-preview { width: 56px; height: 56px; border-radius: 8px; object-fit: cover; border: 1px solid var(--color-border); }
    .img-upload-text { font-size: 12px; color: var(--color-muted); }
    .img-upload-text strong { color: var(--color-secondary); }

    .hidden { display: none !important; }
  </style>
</head>
<body>

<!-- ======= LOGIN ======= -->
<div id="page-login">
  <div class="login-wrap">
    <div class="login-logo-card">
      <div class="login-logo-icon">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3C7 3 3 7 3 12s4 9 9 9 9-4 9-9-4-9-9-9zm0 0c0 0-2 4-2 9s2 9 2 9m0-18c0 0 2 4 2 9s-2 9-2 9M3 12h18"/></svg>
      </div>
      <div class="login-title">Ulam Sari Admin</div>
      <div class="login-sub">Essence of Javanese Tradition</div>
    </div>
    <div class="login-form-card">
      <div id="login-error" class="login-error">Email atau password salah.</div>
      <div class="field-label">Email</div>
      <div class="field-wrap">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
        <input id="login-email" type="email" placeholder="email" />
      </div>
      <div class="field-label">Password <span class="field-link">Lupa Password?</span></div>
      <div class="field-wrap">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
        <input id="login-password" type="password" placeholder="GÇóGÇóGÇóGÇóGÇóGÇóGÇóGÇó" />
        <button class="btn-toggle-pwd" onclick="togglePwd()" type="button" aria-label="Toggle password">
          <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </button>
      </div>
      <button class="btn-login" onclick="doLogin()">
        Masuk ke Dashboard
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
      </button>
    </div>
  </div>
  <div class="login-footer">-¬ 2026 Ulam Sari. Admin Portal.</div>
</div>

<!-- ======= APP ======= -->
<div id="page-app" class="hidden">
<div id="app">
  <!-- SIDEBAR -->
  <aside>
    <div class="brand">
      <div class="brand-logo">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3C7 3 3 7 3 12s4 9 9 9 9-4 9-9-4-9-9-9zm0 0c0 0-2 4-2 9s2 9 2 9m0-18c0 0 2 4 2 9s-2 9-2 9M3 12h18"/></svg>
      </div>
      <span class="brand-name">Ulam Sari</span>
    </div>
    <div class="user-card">
      <div class="avatar">US</div>
      <div><div class="user-name">Ulam Sari Admin</div><div class="user-role">Administrator</div></div>
    </div>
    <nav>
      <button class="nav-item active" id="nav-dashboard" onclick="showPage('dashboard')">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Dashboard Overview
      </button>
      <button class="nav-item" id="nav-menu" onclick="showPage('menu')">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Manajemen Menu
      </button>
      <button class="nav-item" id="nav-reservasi" onclick="showPage('reservasi')">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
        Daftar Reservasi
      </button>
    </nav>
    <div class="sidebar-bottom">
      <button class="btn-new" onclick="showPage('menu'); openMenuModal()">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
        Buat Pesanan Baru
      </button>
      <div class="nav-footer">
        <button class="nav-item">
          <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          Pengaturan
        </button>
        <button class="nav-item nav-logout" onclick="doLogout()">
          <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
          Logout
        </button>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div style="flex:1;display:flex;flex-direction:column;min-width:0;">
    <header>
      <div class="header-title">Ulam Sari GÇö <span>Admin Dashboard</span></div>
      <button class="btn-logout" onclick="doLogout()">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
        Logout
      </button>
    </header>
    <div class="page-body">

      <!-- DASHBOARD -->
      <div id="content-dashboard">
        <div class="page-h1">Dashboard Overview</div>
        <div class="page-sub">Welcome back. Here is the summary of Ulam Sari's operations today.</div>
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-badge badge-green">GùÅ Active</div>
            <div class="stat-icon stat-icon-orange">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div class="stat-number" id="stat-total-menu">{{ count($menus) }}</div>
            <div class="stat-label">Total Menu Items</div>
          </div>
          <div class="stat-card">
            <div class="stat-badge badge-orange">GÜá Requires Action</div>
            <div class="stat-icon stat-icon-amber">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
            </div>
            <div class="stat-number" id="stat-pending">{{ $reservations->where('status', 'menunggu')->count() }}</div>
            <div class="stat-label">Pending Reservations</div>
          </div>
          <div class="stat-card">
            <div class="stat-badge badge-muted">+15% vs Yesterday</div>
            <div class="stat-icon stat-icon-muted">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
            <div class="stat-number">342</div>
            <div class="stat-label">Today's Visitors</div>
          </div>
        </div>
        <div class="glass-card activity-card">
          <div class="activity-header">
            <div class="activity-title">Recent Activity</div>
            <button class="btn-view-all">View All</button>
          </div>
          <div id="activity-list"></div>
        </div>
      </div>

      <!-- MENU -->
      <div id="content-menu" class="hidden">
        <div class="menu-top">
          <div>
            <div class="page-h1">Manajemen Menu</div>
            <div class="page-sub" style="margin-bottom:0;">Kelola hidangan, harga, dan ketersediaan menu restoran.</div>
          </div>
          <button class="btn-primary" onclick="openMenuModal()">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Tambah Menu Baru
          </button>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
          <div class="cat-tabs" id="cat-tabs"></div>
          <select class="sort-select" id="menu-sort" onchange="renderMenuTable()">
            <option>Terbaru</option><option>Nama A-Z</option><option>Harga Tertinggi</option><option>Harga Terendah</option>
          </select>
        </div>
        <div class="glass-card" style="overflow:hidden;">
          <table>
            <thead>
              <tr>
                <th style="width:44px;"><input type="checkbox" onchange="toggleAllMenu(this)" style="accent-color:var(--color-secondary);" /></th>
                <th>Menu Item</th><th>Kategori</th><th>Harga</th><th>Status</th><th>Aksi</th>
              </tr>
            </thead>
            <tbody id="menu-tbody"></tbody>
          </table>
          <div class="table-footer">
            <span class="table-info" id="menu-info"></span>
            <div class="pagination" id="menu-pagination"></div>
          </div>
        </div>
      </div>

      <!-- RESERVASI -->
      <div id="content-reservasi" class="hidden">
        <div class="menu-top">
          <div>
            <div class="page-h1">Manajemen Reservasi</div>
            <div class="page-sub" style="margin-bottom:0;">Kelola daftar reservasi pelanggan dan konfirmasi ketersediaan meja.</div>
          </div>
          <div class="rsv-filters">
            <select class="filter-select" id="filter-status" onchange="renderReservasi()">
              <option value="">Semua Status</option>
              <option value="menunggu">Menunggu</option>
              <option value="dikonfirmasi">Dikonfirmasi</option>
              <option value="ditolak">Ditolak</option>
            </select>
            <select class="filter-select">
              <option>Hari Ini</option><option>Minggu Ini</option><option>Bulan Ini</option>
            </select>
          </div>
        </div>
        <div class="rsv-grid" id="reservasi-grid"></div>
      </div>

    </div>
  </div>
</div>
</div>

<!-- MODAL MENU -->
<div class="modal-backdrop" id="modal-menu">
  <div class="modal">
    <div class="modal-head">
      <div class="modal-title" id="modal-menu-title">Tambah Menu Baru</div>
      <button class="btn-close" onclick="closeMenuModal()" aria-label="Tutup">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <!-- Image Upload -->
    <div class="modal-field">
      <label class="modal-label">Gambar Menu</label>
      <div class="img-upload-area" id="img-upload-area">
        <input type="file" accept="image/*" id="modal-image" onchange="previewMenuImage(this)" />
        <img id="img-preview" class="img-upload-preview hidden" src="" alt="Preview" />
        <div id="img-upload-placeholder" class="img-upload-text">
          <svg style="width:24px;height:24px;color:var(--color-muted);margin-bottom:4px;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
          <br/>Klik atau drag untuk <strong>upload gambar</strong>
        </div>
      </div>
    </div>
    <div class="modal-field"><label class="modal-label">Nama Menu</label><input class="modal-input" id="modal-name" type="text" placeholder="Nama hidangan..." /></div>
    <div class="modal-field"><label class="modal-label">Deskripsi</label><input class="modal-input" id="modal-desc" type="text" placeholder="Deskripsi singkat..." /></div>
    <div class="modal-grid2">
      <div class="modal-field">
        <label class="modal-label">Kategori</label>
        <select class="modal-input" id="modal-cat">
          <option>Ikan Bakar</option><option>Ikan Goreng</option><option>Ayam &amp; Bebek</option><option>Sayuran</option><option>Minuman Tradisional</option>
        </select>
      </div>
      <div class="modal-field">
        <label class="modal-label">Harga (Rp)</label>
        <input class="modal-input" id="modal-price" type="number" placeholder="0" />
      </div>
    </div>
    <div class="modal-field">
      <label class="modal-label">Status</label>
      <select class="modal-input" id="modal-status"><option value="tersedia">Tersedia</option><option value="habis">Habis</option></select>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeMenuModal()">Batal</button>
      <button class="btn-save" onclick="saveMenu()">Simpan</button>
    </div>
  </div>
</div>

<!-- MODAL DETAIL RESERVASI -->
<div class="modal-backdrop" id="modal-rsv">
  <div class="modal">
    <div class="modal-head">
      <div class="modal-title">Detail Reservasi</div>
      <button class="btn-close" onclick="closeRsvModal()" aria-label="Tutup">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div id="modal-rsv-body" style="font-size:13px;line-height:1.8;"></div>
    <div class="modal-footer"><button class="btn-cancel" onclick="closeRsvModal()">Tutup</button></div>
  </div>
</div>

<script>
// CSRF Token Setup
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// CSRF Token Setup GÇö must be 'let' because login regenerates the session/token
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Initial Data loaded from MySQL
let menus = @json($menus);
let reservations = @json($reservations);
let activities = @json($activities);

const PLACEHOLDER_SVG = `data:image/svg+xml,${encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none"><rect width="48" height="48" rx="8" fill="%23F5F0EB"/><path d="M24 14c-1.1 0-2 .9-2 2v4h-4c-1.1 0-2 .9-2 2s.9 2 2 2h4v4c0 1.1.9 2 2 2s2-.9 2-2v-4h4c1.1 0 2-.9 2-2s-.9-2-2-2h-4v-4c0-1.1-.9-2-2-2z" fill="%238D6E63"/><path d="M15 34h18" stroke="%238D6E63" stroke-width="2" stroke-linecap="round"/></svg>')}`;

const CATS = ['Semua','Ikan Bakar','Ikan Goreng','Ayam & Bebek','Sayuran','Minuman Tradisional'];
let catFilter = 'Semua', menuPage = 1, currentEditId = null, pendingImageBase64 = '';
const PER_PAGE = 10;

// =========== AUTH ===========
async function doLogin() {
  const email = document.getElementById('login-email').value;
  const password = document.getElementById('login-password').value;
  const err = document.getElementById('login-error');

  try {
    const res = await fetch('/admin/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ email, password })
    });
    const data = await res.json();
    if (res.ok && data.success) {
      // Update CSRF token GÇö session was regenerated
      if (data.csrf_token) csrfToken = data.csrf_token;
      err.style.display = 'none';
      document.getElementById('page-login').classList.add('hidden');
      document.getElementById('page-app').classList.remove('hidden');
      showPage('dashboard');
    } else {
      err.textContent = data.message || 'Email atau password salah.';
      err.style.display = 'block';
    }
  } catch (e) {
    err.textContent = 'Koneksi error.';
    err.style.display = 'block';
  }
}

async function doLogout() {
  try {
    await fetch('/admin/api/logout', {
      method: 'POST',
      headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
    });
  } catch (e) {}
  document.getElementById('page-app').classList.add('hidden');
  document.getElementById('page-login').classList.remove('hidden');
  document.getElementById('login-email').value = '';
  document.getElementById('login-password').value = '';
}

function togglePwd() {
  const p = document.getElementById('login-password');
  p.type = p.type === 'password' ? 'text' : 'password';
}
document.addEventListener('keydown', e => {
  if (e.key === 'Enter' && !document.getElementById('page-login').classList.contains('hidden')) doLogin();
});

// =========== NAV ===========
function showPage(page) {
  ['dashboard','menu','reservasi'].forEach(p => {
    document.getElementById('content-'+p).classList.toggle('hidden', p !== page);
    const n = document.getElementById('nav-'+p);
    if (n) { n.classList.toggle('active', p === page); }
  });
  if (page === 'dashboard') { renderActivity(); animateIn('.stat-card, .activity-card'); }
  if (page === 'menu') { buildCatTabs(); renderMenuTable(); }
  if (page === 'reservasi') { renderReservasi(); }
}

// =========== GSAP ===========
function animateIn(selector) {
  if (!window.gsap) return;
  const els = document.querySelectorAll(selector);
  if (!els.length) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  gsap.from(els, { opacity:0, scale:0.94, y:16, duration:0.4, stagger:{ each:0.06, from:'start' }, ease:'back.out(1.4)', clearProps:'all' });
}

// =========== DASHBOARD ===========
function renderActivity() {
  document.getElementById('activity-list').innerHTML = activities.map(a => `
    <div class="activity-item">
      <div style="display:flex;gap:10px;align-items:flex-start;flex:1;">
        <div class="activity-dot ${a.dot}"></div>
        <div><div class="activity-text">${a.text}</div><div class="activity-sub">${a.sub || ''}</div></div>
      </div>
      <div class="activity-time">${a.time_label || ''}</div>
    </div>`).join('');
}
function updateStats() {
  document.getElementById('stat-pending').textContent = reservations.filter(r=>r.status==='menunggu').length;
  document.getElementById('stat-total-menu').textContent = menus.length;
}

// =========== MENU ===========
function buildCatTabs() {
  document.getElementById('cat-tabs').innerHTML = CATS.map(c => `
    <button class="cat-tab ${c===catFilter?'active':''}" onclick="filterCat('${c}')">${c==='Semua'?'Semua Kategori':c}</button>`).join('');
}
function filterCat(c) { catFilter=c; menuPage=1; buildCatTabs(); renderMenuTable(); }

function getMenus() {
  let d = catFilter==='Semua' ? [...menus] : menus.filter(m=>m.cat===catFilter);
  const s = document.getElementById('menu-sort')?.value||'Terbaru';
  if (s==='Nama A-Z') d.sort((a,b)=>a.name.localeCompare(b.name));
  else if (s==='Harga Tertinggi') d.sort((a,b)=>b.price-a.price);
  else if (s==='Harga Terendah') d.sort((a,b)=>a.price-b.price);
  else d.sort((a,b)=>b.id-a.id);
  return d;
}

function renderMenuTable() {
  const data = getMenus(), total = data.length;
  const pages = Math.max(1, Math.ceil(total/PER_PAGE));
  if (menuPage>pages) menuPage=1;
  const slice = data.slice((menuPage-1)*PER_PAGE, menuPage*PER_PAGE);

  document.getElementById('menu-tbody').innerHTML = slice.map(m => `
    <tr>
      <td><input type="checkbox" class="menu-cb" style="accent-color:var(--color-secondary);" /></td>
      <td>
        <div style="display:flex;align-items:center;gap:12px;">
          <div class="menu-thumb">${m.image ? `<img src="${m.image}" alt="${m.name}"/>` : `<img src="${PLACEHOLDER_SVG}" alt="placeholder"/>`}</div>
          <div><div class="menu-name">${m.name}</div><div class="menu-desc">${m.desc || ''}</div></div>
        </div>
      </td>
      <td><span class="cat-pill">${m.cat}</span></td>
      <td class="price">Rp ${Number(m.price).toLocaleString('id-ID')}</td>
      <td>
        <span class="${m.status==='tersedia'?'status-ok':'status-bad'}" style="display:flex;align-items:center;font-size:12px;font-weight:500;">
          <span class="status-dot"></span>${m.status==='tersedia'?'Tersedia':'Habis'}
        </span>
      </td>
      <td>
        <div style="display:flex;gap:6px;">
          <button class="action-btn" onclick="editMenu(${m.id})" aria-label="Edit" title="Edit">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
          </button>
          <button class="action-btn del" onclick="deleteMenu(${m.id})" aria-label="Hapus" title="Hapus">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
          </button>
        </div>
      </td>
    </tr>`).join('') || `<tr><td colspan="6" style="text-align:center;padding:40px;color:var(--color-muted);">Tidak ada menu</td></tr>`;

  document.getElementById('menu-info').textContent = total > 0
    ? `Showing ${(menuPage-1)*PER_PAGE+1}GÇô${Math.min(menuPage*PER_PAGE,total)} of ${total}`
    : '0 items';

  const pg = document.getElementById('menu-pagination');
  pg.innerHTML = '';
  if (pages<=1) return;
  const pgBtn = (label, p, active, disabled) => {
    const b = document.createElement('button');
    b.className = 'pg-btn' + (active?' active':'');
    b.textContent = label; b.disabled = disabled;
    if (!disabled) b.onclick = () => { menuPage=p; renderMenuTable(); };
    return b;
  };
  pg.appendChild(pgBtn('GÇ¦', menuPage-1, false, menuPage===1));
  for (let i=1;i<=pages;i++) {
    if (i===1||i===pages||Math.abs(i-menuPage)<=1) pg.appendChild(pgBtn(i,i,i===menuPage,false));
    else if (Math.abs(i-menuPage)===2) { const s=document.createElement('span'); s.textContent='GÇª'; s.style.cssText='color:var(--color-muted);padding:0 4px;font-size:12px;align-self:center;'; pg.appendChild(s); }
  }
  pg.appendChild(pgBtn('GÇ¦', menuPage+1, false, menuPage===pages));
}

function toggleAllMenu(m) { document.querySelectorAll('.menu-cb').forEach(c=>c.checked=m.checked); }

// =========== IMAGE UPLOAD ===========
function previewMenuImage(input) {
  const file = input.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = function(e) {
    pendingImageBase64 = e.target.result;
    const preview = document.getElementById('img-preview');
    preview.src = pendingImageBase64;
    preview.classList.remove('hidden');
    document.getElementById('img-upload-placeholder').classList.add('hidden');
  };
  reader.readAsDataURL(file);
}

function resetImageUpload() {
  pendingImageBase64 = '';
  document.getElementById('modal-image').value = '';
  document.getElementById('img-preview').classList.add('hidden');
  document.getElementById('img-preview').src = '';
  document.getElementById('img-upload-placeholder').classList.remove('hidden');
}

// =========== MODAL MENU ===========
function openMenuModal(id=null) {
  currentEditId=id;
  document.getElementById('modal-menu-title').textContent = id?'Edit Menu':'Tambah Menu Baru';
  resetImageUpload();
  if (id) {
    const m=menus.find(x=>x.id===id);
    document.getElementById('modal-name').value=m.name;
    document.getElementById('modal-desc').value=m.desc || '';
    document.getElementById('modal-cat').value=m.cat;
    document.getElementById('modal-price').value=m.price;
    document.getElementById('modal-status').value=m.status;
    if (m.image) {
      pendingImageBase64 = m.image;
      const preview = document.getElementById('img-preview');
      preview.src = m.image;
      preview.classList.remove('hidden');
      document.getElementById('img-upload-placeholder').classList.add('hidden');
    }
  } else {
    ['modal-name','modal-desc','modal-price'].forEach(id=>document.getElementById(id).value='');
    document.getElementById('modal-status').value='tersedia';
  }
  document.getElementById('modal-menu').classList.add('open');
}
function closeMenuModal() { document.getElementById('modal-menu').classList.remove('open'); }

async function saveMenu() {
  const name = document.getElementById('modal-name').value.trim();
  if (!name) { alert('Nama menu wajib diisi.'); return; }
  const data = {
    name,
    desc: document.getElementById('modal-desc').value.trim(),
    cat: document.getElementById('modal-cat').value,
    price: parseFloat(document.getElementById('modal-price').value)||0,
    status: document.getElementById('modal-status').value,
    image: pendingImageBase64
  };

  try {
    let url = '/admin/api/menus';
    let method = 'POST';
    if (currentEditId) {
      url = `/admin/api/menus/${currentEditId}`;
      method = 'PUT';
      if (!data.image) {
        const existing = menus.find(x=>x.id===currentEditId);
        if (existing) data.image = existing.image;
      }
    }

    const res = await fetch(url, {
      method: method,
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(data)
    });
    const resData = await res.json();

    if (res.ok && resData.success) {
      if (currentEditId) {
        const i=menus.findIndex(x=>x.id===currentEditId);
        menus[i] = resData.data;
      } else {
        menus.unshift(resData.data);
      }
      closeMenuModal();
      renderMenuTable();
      updateStats();
    } else {
      alert('Gagal menyimpan menu.');
    }
  } catch (e) {
    alert('Terjadi kesalahan koneksi.');
  }
}

function editMenu(id) { openMenuModal(id); }

async function deleteMenu(id) {
  if (!confirm('Hapus menu ini?')) return;
  try {
    const res = await fetch(`/admin/api/menus/${id}`, {
      method: 'DELETE',
      headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
    });
    const resData = await res.json();
    if (res.ok && resData.success) {
      menus = menus.filter(m=>m.id!==id);
      renderMenuTable();
      updateStats();
    } else {
      alert('Gagal menghapus menu.');
    }
  } catch (e) {
    alert('Terjadi kesalahan server.');
  }
}

// =========== RESERVASI ===========
const statusLabel = {menunggu:'Menunggu Konfirmasi',dikonfirmasi:'Dikonfirmasi',ditolak:'Ditolak'};
function renderReservasi() {
  const sf = document.getElementById('filter-status').value;
  const data = sf ? reservations.filter(r=>r.status===sf) : [...reservations];
  const grid = document.getElementById('reservasi-grid');
  grid.innerHTML = data.length ? data.map(r => `
    <div class="rsv-card rsv-card-${r.status}">
      <div class="rsv-header">
        <span class="rsv-badge rsv-badge-${r.status}">${statusLabel[r.status]}</span>
        <span class="rsv-code">#RSV-${String(r.id).padStart(3,'0')}</span>
      </div>
      <div class="rsv-name">${r.customer}</div>
      <div class="rsv-detail">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5"/></svg>
        ${r.date}, ${r.time}
      </div>
      <div class="rsv-detail">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
        ${r.guests} Orang
      </div>
      <div class="rsv-detail">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
        ${r.phone || '-'}
      </div>
      <div class="rsv-actions">
        ${r.status==='menunggu' ? `
          <button class="btn-confirm" onclick="updateRsv(${r.id},'dikonfirmasi')">Konfirmasi</button>
          <button class="btn-outline" onclick="updateRsv(${r.id},'ditolak')">Tolak</button>
        ` : `
          <button class="btn-detail" onclick="openRsvModal(${r.id})">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
            Detail Reservasi
          </button>
        `}
      </div>
    </div>`).join('') : `<div style="grid-column:1/-1;text-align:center;padding:60px 0;color:var(--color-muted);">Tidak ada reservasi</div>`;

  if (!sf) animateIn('.rsv-card');
  updateStats();
}

async function updateRsv(id, status) {
  try {
    const res = await fetch(`/admin/api/reservations/${id}/status`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ status })
    });
    const resData = await res.json();
    if (res.ok && resData.success) {
      const r = reservations.find(x=>x.id===id);
      if (r) r.status=status;
      renderReservasi();
      updateStats();
    }
  } catch (e) {
    alert('Gagal update status reservasi.');
  }
}

function openRsvModal(id) {
  const r = reservations.find(x=>x.id===id);
  document.getElementById('modal-rsv-body').innerHTML = `
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px 20px;background:rgba(62,39,35,0.03);border:1px solid var(--color-border);border-radius:12px;padding:16px;margin-bottom:16px;">
      <div><div style="font-size:10px;color:var(--color-muted);text-transform:uppercase;letter-spacing:.7px;margin-bottom:4px;">Kode</div><div style="font-weight:700;color:var(--color-secondary);">#RSV-${String(r.id).padStart(3,'0')}</div></div>
      <div><div style="font-size:10px;color:var(--color-muted);text-transform:uppercase;letter-spacing:.7px;margin-bottom:4px;">Status</div><div>${statusLabel[r.status]}</div></div>
      <div><div style="font-size:10px;color:var(--color-muted);text-transform:uppercase;letter-spacing:.7px;margin-bottom:4px;">Pelanggan</div><div style="font-weight:600;">${r.customer}</div></div>
      <div><div style="font-size:10px;color:var(--color-muted);text-transform:uppercase;letter-spacing:.7px;margin-bottom:4px;">Telepon</div><div>${r.phone || '-'}</div></div>
      <div><div style="font-size:10px;color:var(--color-muted);text-transform:uppercase;letter-spacing:.7px;margin-bottom:4px;">Tanggal</div><div>${r.date}</div></div>
      <div><div style="font-size:10px;color:var(--color-muted);text-transform:uppercase;letter-spacing:.7px;margin-bottom:4px;">Waktu & Tamu</div><div>${r.time} -+ ${r.guests} org</div></div>
    </div>`;
  document.getElementById('modal-rsv').classList.add('open');
}
function closeRsvModal() { document.getElementById('modal-rsv').classList.remove('open'); }

// Close on backdrop
document.getElementById('modal-menu').addEventListener('click', e => { if(e.target===e.currentTarget) closeMenuModal(); });
document.getElementById('modal-rsv').addEventListener('click', e => { if(e.target===e.currentTarget) closeRsvModal(); });
</script>
</body>
</html>


