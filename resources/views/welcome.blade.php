<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transactions Core - Sistema de Transações</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
            color: #e2e8f0;
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header */
        header {
            padding: 2rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(15, 15, 35, 0.8);
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        
        .nav-links a {
            color: #cbd5e1;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }
        
        .nav-links a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }
        
        /* Hero Section */
        .hero {
            text-align: center;
            padding: 6rem 0 4rem;
            position: relative;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.25rem;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto 2rem;
        }
        
        /* Endpoints Section */
        .endpoints-section {
            padding: 4rem 0;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: #fff;
        }
        
        .endpoints-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .endpoint-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 2rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }
        
        .endpoint-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .endpoint-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(102, 126, 234, 0.5);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .endpoint-card:hover::before {
            transform: scaleX(1);
        }
        
        .method-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }
        
        .method-get {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        
        .method-post {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        
        .endpoint-path {
            font-family: 'Monaco', 'Menlo', 'Courier New', monospace;
            font-size: 1.1rem;
            color: #fff;
            margin-bottom: 1rem;
            word-break: break-all;
        }
        
        .endpoint-description {
            color: #94a3b8;
            line-height: 1.6;
        }
        
        /* Info Section */
        .info-section {
            padding: 4rem 0;
            text-align: center;
        }
        
        .info-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 2.5rem;
            max-width: 800px;
            margin: 0 auto;
            backdrop-filter: blur(10px);
        }
        
        .info-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #fff;
        }
        
        .info-card p {
            color: #94a3b8;
            margin-bottom: 1.5rem;
        }
        
        .postman-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: rgba(255, 108, 55, 0.2);
            border: 1px solid rgba(255, 108, 55, 0.3);
            border-radius: 0.5rem;
            color: #ff8c6b;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .postman-badge:hover {
            background: rgba(255, 108, 55, 0.3);
            transform: translateY(-2px);
        }
        
        /* Footer */
        footer {
            padding: 3rem 0;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #64748b;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .endpoints-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .nav-links a {
                padding: 0.5rem;
                font-size: 0.875rem;
            }
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .endpoint-card {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        .endpoint-card:nth-child(1) { animation-delay: 0.1s; }
        .endpoint-card:nth-child(2) { animation-delay: 0.2s; }
        .endpoint-card:nth-child(3) { animation-delay: 0.3s; }
        .endpoint-card:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">🏦 Transactions Core</div>
                <div class="nav-links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Registrar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Sistema de Transações Bancárias</h1>
                <p>API completa para gerenciamento de contas, depósitos e transferências financeiras</p>
            </div>
        </section>

        <section class="endpoints-section">
            <div class="container">
                <h2 class="section-title">📡 Endpoints Principais</h2>
                <div class="endpoints-grid">
                    <div class="endpoint-card">
                        <span class="method-badge method-get">GET</span>
                        <div class="endpoint-path">/accounts/me</div>
                        <div class="endpoint-description">
                            Retorna as informações da conta autenticada. Inclui dados do usuário, saldo atual e histórico de transações.
                        </div>
                    </div>

                    <div class="endpoint-card">
                        <span class="method-badge method-post">POST</span>
                        <div class="endpoint-path">/accounts</div>
                        <div class="endpoint-description">
                            Cria uma nova conta no sistema. Requer informações básicas do usuário e configurações iniciais da conta.
                        </div>
                    </div>

                    <div class="endpoint-card">
                        <span class="method-badge method-post">POST</span>
                        <div class="endpoint-path">/deposits</div>
                        <div class="endpoint-description">
                            Injeta dinheiro no saldo da conta (depósito). Permite adicionar fundos à conta autenticada de forma segura.
                        </div>
                    </div>

                    <div class="endpoint-card">
                        <span class="method-badge method-post">POST</span>
                        <div class="endpoint-path">/transfer</div>
                        <div class="endpoint-description">
                            Transfere dinheiro entre contas existentes. Realiza transferências seguras com validação de saldo e destinatário.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="info-section">
            <div class="container">
                <div class="info-card">
                    <h3>🚀 Comece Agora</h3>
                    <p>
                        Para facilitar a integração e testes, disponibilizamos uma collection do Postman com todos os endpoints configurados e prontos para uso.
                    </p>
                    <a href="{{ route('postman.download') }}" class="postman-badge">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm1.502 8.414c.057-.057.135-.085.213-.085h4.285c.078 0 .156.028.213.085l1.502 1.502c.057.057.085.135.085.213v4.285c0 .078-.028.156-.085.213l-1.502 1.502c-.057.057-.135.085-.213.085h-4.285c-.078 0-.156-.028-.213-.085l-1.502-1.502c-.057-.057-.085-.135-.085-.213v-4.285c0-.078.028-.156.085-.213l1.502-1.502z"/>
                        </svg>
                        Transactions Core.postman_collection.json
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>Transactions Core v1.0 | PHP v{{ PHP_VERSION }}</p>
        </div>
    </footer>
</body>
</html>
