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
            max-width: 1400px;
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
            padding: 4rem 0 3rem;
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
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.125rem;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Token Display */
        .token-display {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 1rem;
            margin: 2rem auto;
            max-width: 800px;
            display: none;
        }
        
        .token-display.active {
            display: block;
        }
        
        .token-display label {
            display: block;
            font-size: 0.875rem;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }
        
        .token-display input {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.75rem;
            color: #fff;
            font-family: monospace;
            font-size: 0.875rem;
        }
        
        /* Endpoints Section */
        .endpoints-section {
            padding: 3rem 0;
        }
        
        .section-group {
            margin-bottom: 4rem;
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #fff;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(102, 126, 234, 0.3);
        }
        
        .endpoints-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 2rem;
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
        
        .endpoint-card:hover::before {
            transform: scaleX(1);
        }
        
        .endpoint-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .method-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
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
            font-size: 1rem;
            color: #fff;
            flex: 1;
        }
        
        .endpoint-description {
            color: #94a3b8;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        /* Form Styles */
        .endpoint-form {
            margin-bottom: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group label {
            display: block;
            font-size: 0.875rem;
            color: #cbd5e1;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.75rem;
            color: #fff;
            font-family: inherit;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-group input::placeholder {
            color: #64748b;
        }
        
        .bearer-token-input {
            font-family: 'Monaco', 'Menlo', 'Courier New', monospace;
            font-size: 0.85rem;
        }
        
        .token-hint {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.25rem;
            font-style: italic;
        }
        
        .btn-send {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .btn-send:active {
            transform: translateY(0);
        }
        
        .btn-send:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        /* Response Display */
        .response-container {
            margin-top: 1.5rem;
            display: none;
        }
        
        .response-container.active {
            display: block;
        }
        
        .response-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }
        
        .response-status {
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-success {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
        }
        
        .status-error {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }
        
        .response-body {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 1rem;
            font-family: 'Monaco', 'Menlo', 'Courier New', monospace;
            font-size: 0.85rem;
            color: #e2e8f0;
            max-height: 300px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-break: break-all;
        }
        
        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            margin-right: 0.5rem;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
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
                font-size: 2rem;
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
                
                <div class="token-display" id="tokenDisplay">
                    <label>Token JWT (salvo automaticamente após login):</label>
                    <input type="text" id="tokenInput" readonly placeholder="Faça login para obter o token">
                </div>
            </div>
        </section>

        <section class="endpoints-section">
            <div class="container">
                <!-- Accounts Section -->
                <div class="section-group">
                    <h2 class="section-title">📁 Accounts</h2>
                    <div class="endpoints-grid">
                        <!-- Create Account -->
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="method-badge method-post">POST</span>
                                <div class="endpoint-path">/accounts</div>
                            </div>
                            <div class="endpoint-description">
                                Cria uma nova conta no sistema. Requer documento, senha e saldo inicial.
                            </div>
                            <form class="endpoint-form" data-endpoint="accounts" data-method="POST">
                                <div class="form-group">
                                    <label>Document (CPF/CNPJ):</label>
                                    <input type="text" name="document" placeholder="13857868090" required>
                                </div>
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" name="password" placeholder="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Balance:</label>
                                    <input type="text" name="balance" class="money-input" placeholder="100.00" required>
                                </div>
                                <button type="submit" class="btn-send">Enviar Requisição</button>
                            </form>
                            <div class="response-container" id="response-accounts-POST"></div>
                        </div>

                        <!-- Me -->
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="method-badge method-get">GET</span>
                                <div class="endpoint-path">/accounts/me</div>
                            </div>
                            <div class="endpoint-description">
                                Retorna as informações da conta autenticada. Requer token JWT.
                            </div>
                            <form class="endpoint-form" data-endpoint="accounts/me" data-method="GET" data-auth="true">
                                <div class="form-group">
                                    <label>Bearer Token:</label>
                                    <input type="text" name="bearer_token" class="bearer-token-input" required placeholder="Token JWT obrigatório">
                                    <div class="token-hint">Clique para preencher com token salvo</div>
                                </div>
                                <button type="submit" class="btn-send">Enviar Requisição</button>
                            </form>
                            <div class="response-container" id="response-accounts/me-GET"></div>
                        </div>
                    </div>
                </div>

                <!-- Login Section -->
                <div class="section-group">
                    <h2 class="section-title">🔐 Login</h2>
                    <div class="endpoints-grid">
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="method-badge method-post">POST</span>
                                <div class="endpoint-path">/login</div>
                            </div>
                            <div class="endpoint-description">
                                Autentica um usuário e retorna um token JWT para uso nas requisições protegidas.
                            </div>
                            <form class="endpoint-form" data-endpoint="login" data-method="POST" data-save-token="true">
                                <div class="form-group">
                                    <label>Document (CPF/CNPJ):</label>
                                    <input type="text" name="document" placeholder="68704299185395" required>
                                </div>
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" name="password" placeholder="password" required>
                                </div>
                                <button type="submit" class="btn-send">Enviar Requisição</button>
                            </form>
                            <div class="response-container" id="response-login-POST"></div>
                        </div>
                    </div>
                </div>

                <!-- Transactions Section -->
                <div class="section-group">
                    <h2 class="section-title">💸 Transactions</h2>
                    <div class="endpoints-grid">
                        <!-- Transfer -->
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="method-badge method-post">POST</span>
                                <div class="endpoint-path">/accounts/transactions/transfers</div>
                            </div>
                            <div class="endpoint-description">
                                Transfere dinheiro entre contas existentes. Requer token JWT.
                            </div>
                            <form class="endpoint-form" data-endpoint="accounts/transactions/transfers" data-method="POST" data-auth="true">
                                <div class="form-group">
                                    <label>Receiver Account ID:</label>
                                    <input type="number" name="receiverAccountId" placeholder="5" required>
                                </div>
                                <div class="form-group">
                                    <label>Amount:</label>
                                    <input type="text" name="amount" class="money-input" placeholder="10.31" required>
                                </div>
                                <div class="form-group">
                                    <label>Type:</label>
                                    <select name="type" required>
                                        <option value="debit">Debit</option>
                                        <option value="credit">Credit</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Description:</label>
                                    <input type="text" name="description" placeholder="Thank you">
                                </div>
                                <div class="form-group">
                                    <label>Bearer Token:</label>
                                    <input type="text" name="bearer_token" class="bearer-token-input" required placeholder="Token JWT obrigatório">
                                    <div class="token-hint">Clique para preencher com token salvo</div>
                                </div>
                                <button type="submit" class="btn-send">Enviar Requisição</button>
                            </form>
                            <div class="response-container" id="response-accounts/transactions/transfers-POST"></div>
                        </div>

                        <!-- Deposit -->
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="method-badge method-post">POST</span>
                                <div class="endpoint-path">/deposits</div>
                            </div>
                            <div class="endpoint-description">
                                Injeta dinheiro no saldo da conta (depósito). Requer token JWT.
                            </div>
                            <form class="endpoint-form" data-endpoint="deposits" data-method="POST" data-auth="true">
                                <div class="form-group">
                                    <label>Receiver Account ID:</label>
                                    <input type="number" name="receiverAccountId" placeholder="4" required>
                                </div>
                                <div class="form-group">
                                    <label>Amount:</label>
                                    <input type="text" name="amount" class="money-input" placeholder="100000" required>
                                </div>
                                <div class="form-group">
                                    <label>Description:</label>
                                    <input type="text" name="description" placeholder="Deposit for project XYZ">
                                </div>
                                <button type="submit" class="btn-send">Enviar Requisição</button>
                            </form>
                            <div class="response-container" id="response-deposits-POST"></div>
                        </div>

                        <!-- All Transactions (Logged User) -->
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="method-badge method-get">GET</span>
                                <div class="endpoint-path">/accounts/transactions</div>
                            </div>
                            <div class="endpoint-description">
                                Retorna todas as transações do usuário autenticado. Requer token JWT.
                            </div>
                            <form class="endpoint-form" data-endpoint="accounts/transactions" data-method="GET" data-auth="true">
                                <div class="form-group">
                                    <label>Page:</label>
                                    <input type="number" name="page" value="1" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Bearer Token:</label>
                                    <input type="text" name="bearer_token" class="bearer-token-input" required placeholder="Token JWT obrigatório">
                                    <div class="token-hint">Clique para preencher com token salvo</div>
                                </div>
                                <button type="submit" class="btn-send">Enviar Requisição</button>
                            </form>
                            <div class="response-container" id="response-accounts/transactions-GET"></div>
                        </div>
                    </div>
                </div>

                <!-- For Admin Section -->
                <div class="section-group">
                    <h2 class="section-title">👑 For Admin</h2>
                    <div class="endpoints-grid">
                        <!-- All Transactions (Admin) -->
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="method-badge method-get">GET</span>
                                <div class="endpoint-path">/transactions</div>
                            </div>
                            <div class="endpoint-description">
                                Retorna todas as transações do sistema (apenas admin). Requer token JWT de admin.
                            </div>
                            <form class="endpoint-form" data-endpoint="transactions" data-method="GET" data-auth="true">
                                <div class="form-group">
                                    <label>Page:</label>
                                    <input type="number" name="page" value="1" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Bearer Token:</label>
                                    <input type="text" name="bearer_token" class="bearer-token-input" required placeholder="Token JWT obrigatório">
                                    <div class="token-hint">Clique para preencher com token salvo</div>
                                </div>
                                <button type="submit" class="btn-send">Enviar Requisição</button>
                            </form>
                            <div class="response-container" id="response-transactions-GET"></div>
                        </div>

                        <!-- All Accounts (Admin) -->
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="method-badge method-get">GET</span>
                                <div class="endpoint-path">/accounts</div>
                            </div>
                            <div class="endpoint-description">
                                Retorna todas as contas do sistema (apenas admin). Requer token JWT de admin.
                            </div>
                            <form class="endpoint-form" data-endpoint="accounts" data-method="GET" data-auth="true">
                                <div class="form-group">
                                    <label>Page:</label>
                                    <input type="number" name="page" value="1" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Bearer Token:</label>
                                    <input type="text" name="bearer_token" class="bearer-token-input" required placeholder="Token JWT obrigatório">
                                    <div class="token-hint">Clique para preencher com token salvo</div>
                                </div>
                                <button type="submit" class="btn-send">Enviar Requisição</button>
                            </form>
                            <div class="response-container" id="response-accounts-GET"></div>
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

    <script>
        const API_BASE_URL = 'https://transactions-core-main-erabqb.laravel.cloud/api';
        
        // Token management
        let authToken = localStorage.getItem('jwt_token') || '';
        
        if (authToken) {
            document.getElementById('tokenInput').value = authToken;
            document.getElementById('tokenDisplay').classList.add('active');
        }
        
        // Auto-fill bearer token inputs when clicked
        document.querySelectorAll('.bearer-token-input').forEach(input => {
            input.addEventListener('focus', function() {
                if (!this.value && authToken) {
                    this.value = authToken;
                }
            });
        });
        
        // Money mask function - formats as user types
        function applyMoneyMask(input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value;
                // Remove everything except numbers and decimal point
                value = value.replace(/[^\d.]/g, '');
                
                // Ensure only one decimal point
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                
                // Limit to 2 decimal places
                if (parts.length === 2 && parts[1].length > 2) {
                    value = parts[0] + '.' + parts[1].substring(0, 2);
                }
                
                // Format with thousands separator
                if (value) {
                    const numValue = parseFloat(value);
                    if (!isNaN(numValue)) {
                        e.target.value = numValue.toLocaleString('pt-BR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    } else {
                        e.target.value = value;
                    }
                } else {
                    e.target.value = '';
                }
            });
            
            input.addEventListener('blur', function(e) {
                let value = e.target.value.replace(/[^\d.]/g, '');
                if (value) {
                    const numValue = parseFloat(value);
                    if (!isNaN(numValue)) {
                        e.target.value = numValue.toLocaleString('pt-BR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                }
            });
        }
        
        // Apply money mask to all money inputs
        document.querySelectorAll('.money-input').forEach(input => {
            applyMoneyMask(input);
        });
        
        // Function to convert money mask to number
        function moneyToNumber(value) {
            if (!value) return 0;
            // Remove formatting and convert to number
            let numValue = value.replace(/\./g, '').replace(',', '.');
            return parseFloat(numValue) || 0;
        }
        
        // Handle all forms
        document.querySelectorAll('.endpoint-form').forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const endpoint = form.dataset.endpoint;
                const method = form.dataset.method;
                const requiresAuth = form.dataset.auth === 'true';
                const saveToken = form.dataset.saveToken === 'true';
                const responseId = `response-${endpoint}-${method}`;
                const responseContainer = document.getElementById(responseId);
                const button = form.querySelector('.btn-send');
                
                // Disable button and show loading
                button.disabled = true;
                button.innerHTML = '<span class="loading"></span>Enviando...';
                
                // Build URL
                let url = `${API_BASE_URL}/${endpoint}`;
                
                // Get bearer token from form input or use saved token
                const bearerTokenInput = form.querySelector('.bearer-token-input');
                let tokenToUse = '';
                if (bearerTokenInput) {
                    // If field exists, it's required
                    tokenToUse = bearerTokenInput.value.trim();
                    if (!tokenToUse && requiresAuth) {
                        // Try to use saved token if field is empty
                        tokenToUse = authToken;
                    }
                } else if (requiresAuth) {
                    // No field, use saved token
                    tokenToUse = authToken;
                }
                
                // Build request options
                const options = {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                };
                
                // Add auth token if required and available
                if (requiresAuth && tokenToUse) {
                    options.headers['Authorization'] = `Bearer ${tokenToUse}`;
                }
                
                // Add body for POST requests
                if (method === 'POST') {
                    const formData = new FormData(form);
                    const body = {};
                    
                    formData.forEach((value, key) => {
                        // Skip bearer_token field - it's only for header
                        if (key === 'bearer_token') {
                            return;
                        }
                        if (key === 'balance' || key === 'amount') {
                            // Convert money mask to number
                            body[key] = moneyToNumber(value);
                        } else if (key === 'receiverAccountId') {
                            body[key] = parseFloat(value);
                        } else if (key === 'page') {
                            body[key] = parseInt(value);
                        } else {
                            body[key] = value;
                        }
                    });
                    
                    options.body = JSON.stringify(body);
                } else {
                    // For GET requests, add query params to URL
                    const formData = new FormData(form);
                    const params = new URLSearchParams();
                    
                    formData.forEach((value, key) => {
                        // Skip bearer_token field - it's only for header
                        if (key === 'bearer_token') {
                            return;
                        }
                        if (value) {
                            params.append(key, value);
                        }
                    });
                    
                    const queryString = params.toString();
                    if (queryString) {
                        url = `${url}?${queryString}`;
                    }
                }
                
                try {
                    const response = await fetch(url, options);
                    let data;
                    
                    try {
                        data = await response.json();
                    } catch (e) {
                        const text = await response.text();
                        data = { error: text || 'Resposta não é JSON válido' };
                    }
                    
                    // Save token if this is a login request
                    if (saveToken && response.ok && data.token) {
                        authToken = data.token;
                        localStorage.setItem('jwt_token', authToken);
                        document.getElementById('tokenInput').value = authToken;
                        document.getElementById('tokenDisplay').classList.add('active');
                    }
                    
                    // Display response
                    responseContainer.innerHTML = `
                        <div class="response-header">
                            <span class="response-status ${response.ok ? 'status-success' : 'status-error'}">
                                Status: ${response.status} ${response.statusText}
                            </span>
                        </div>
                        <div class="response-body">${JSON.stringify(data, null, 2)}</div>
                    `;
                    responseContainer.classList.add('active');
                    
                } catch (error) {
                    responseContainer.innerHTML = `
                        <div class="response-header">
                            <span class="response-status status-error">Erro de Conexão</span>
                        </div>
                        <div class="response-body">${error.message}</div>
                    `;
                    responseContainer.classList.add('active');
                } finally {
                    button.disabled = false;
                    button.innerHTML = 'Enviar Requisição';
                }
            });
        });
    </script>
</body>
</html>
