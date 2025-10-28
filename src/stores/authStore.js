import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
    const user = ref(null)
    const token = ref(localStorage.getItem('token'))
    const isLoading = ref(false)
    const error = ref(null)

    const login = async (email, password) => {
        isLoading.value = true
        error.value = null

        try {
            const response = await fetch('http://localhost:8000/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, password })
            })

            const data = await response.json()

            if (!response.ok) {
                throw new Error(data.message || 'Ошибка аутентификации')
            }

            token.value = data.token
            user.value = data.user

            localStorage.setItem('token', data.token)

            return { success: true }
        } catch (err) {
            error.value = err.message
            return { success: false, error: err.message }
        } finally {
            isLoading.value = false
        }
    }

    const logout = async () => {
        if (token.value) {
            try {
                await fetch('http://localhost:8000/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token.value}`,
                        'Accept': 'application/json'
                    }
                })
            } catch (err) {
                console.error('Ошибка при выходе:', err)
            }
        }

        token.value = null
        user.value = null
        localStorage.removeItem('token')
    }

    const checkAuth = async () => {
        if (!token.value) return false

        try {
            const response = await fetch('http://localhost:8000/api/user', {
                headers: {
                    'Authorization': `Bearer ${token.value}`,
                    'Accept': 'application/json'
                }
            })

            if (response.ok) {
                user.value = await response.json()
                return true
            }
        } catch (err) {
            console.error('Ошибка проверки аутентификации:', err)
        }

        logout()
        return false
    }

    return {
        user,
        token,
        isLoading,
        error,
        login,
        logout,
        checkAuth
    }
})
