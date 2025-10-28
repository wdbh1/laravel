<template>
    <div id="app">
        <div class="container">
            <header>
                <h1>🍳 Кулинарное приложение</h1>
                <nav v-if="authStore.user">
                    <span>Добро пожаловать, {{ authStore.user.name }}!</span>
                    <button @click="handleLogout" :disabled="authStore.isLoading">
                        {{ authStore.isLoading ? 'Выход...' : 'Выйти' }}
                    </button>
                </nav>
            </header>

            <main>
                <!-- Компонент логина -->
                <div v-if="!authStore.user" class="login-section">
                    <h2>Вход в систему</h2>

                    <form @submit.prevent="handleLogin" class="login-form">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input
                                type="email"
                                id="email"
                                v-model="loginForm.email"
                                required
                                placeholder="Введите email"
                            >
                        </div>

                        <div class="form-group">
                            <label for="password">Пароль:</label>
                            <input
                                type="password"
                                id="password"
                                v-model="loginForm.password"
                                required
                                placeholder="Введите пароль"
                            >
                        </div>

                        <button
                            type="submit"
                            :disabled="authStore.isLoading"
                            class="login-btn"
                        >
                            {{ authStore.isLoading ? 'Вход...' : 'Войти' }}
                        </button>
                    </form>

                    <!-- Сообщения об ошибках -->
                    <div v-if="authStore.error" class="error-message">
                        ❌ {{ authStore.error }}
                    </div>
                </div>

                <!-- Основной контент после авторизации -->
                <div v-else class="content-section">
                    <div class="welcome-message">
                        <h2>✅ Успешная авторизация!</h2>
                        <p>Вы вошли в систему как: <strong>{{ authStore.user.email }}</strong></p>

                        <div class="user-info">
                            <h3>Информация о пользователе:</h3>
                            <ul>
                                <li><strong>ID:</strong> {{ authStore.user.id }}</li>
                                <li><strong>Имя:</strong> {{ authStore.user.name }}</li>
                                <li><strong>Email:</strong> {{ authStore.user.email }}</li>
                                <li><strong>Админ:</strong> {{ authStore.user.is_admin ? 'Да' : 'Нет' }}</li>
                            </ul>
                        </div>

                        <div class="features">
                            <h3>Доступные функции:</h3>
                            <ul>
                                <li>📁 Просмотр категорий блюд</li>
                                <li>🍳 Управление рецептами</li>
                                <li>🥗 Работа с ингредиентами</li>
                                <li>👤 Управление профилем</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from './stores/authStore'

const authStore = useAuthStore()

const loginForm = ref({
    email: '',
    password: ''
})

const handleLogin = async () => {
    const result = await authStore.login(loginForm.value.email, loginForm.value.password)

    if (result.success) {
        loginForm.value.email = ''
        loginForm.value.password = ''
    }
}

const handleLogout = async () => {
    await authStore.logout()
}

// Проверяем аутентификацию при загрузке приложения
onMounted(async () => {
    await authStore.checkAuth()
})
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

#app {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    width: 90%;
    max-width: 500px;
    margin: 20px;
}

header {
    background: #2c3e50;
    color: white;
    padding: 20px;
    text-align: center;
}

header h1 {
    margin-bottom: 10px;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

nav button {
    background: #e74c3c;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
}

nav button:hover:not(:disabled) {
    background: #c0392b;
}

nav button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

main {
    padding: 30px;
}

.login-section h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #2c3e50;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #34495e;
}

input {
    padding: 12px;
    border: 2px solid #bdc3c7;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
}

input:focus {
    outline: none;
    border-color: #3498db;
}

.login-btn {
    background: #27ae60;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.login-btn:hover:not(:disabled) {
    background: #219a52;
}

.login-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.error-message {
    background: #e74c3c;
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-top: 15px;
    text-align: center;
}

.content-section {
    text-align: center;
}

.welcome-message h2 {
    color: #27ae60;
    margin-bottom: 15px;
}

.user-info {
    margin-top: 20px;
    text-align: left;
    background: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
}

.user-info h3 {
    margin-bottom: 10px;
    color: #2c3e50;
}

.user-info ul {
    list-style: none;
}

.user-info li {
    padding: 5px 0;
    border-bottom: 1px solid #ecf0f1;
}

.user-info li:last-child {
    border-bottom: none;
}

.features {
    margin-top: 20px;
    text-align: left;
    background: #e8f5e8;
    padding: 15px;
    border-radius: 5px;
    border-left: 4px solid #27ae60;
}

.features h3 {
    margin-bottom: 10px;
    color: #2c3e50;
}

.features ul {
    list-style: none;
}

.features li {
    padding: 8px 0;
    color: #2c3e50;
}

@media (max-width: 480px) {
    .container {
        margin: 10px;
        width: 95%;
    }

    main {
        padding: 20px;
    }

    nav {
        flex-direction: column;
        text-align: center;
    }
}
</style>
