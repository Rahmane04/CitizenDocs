import './bootstrap.js'
import { createApp } from 'vue'

import CitoyenDashboard from './Pages/Citoyen/Dashboard.vue'
import AgentDashboard from './Pages/Agent/Dashboard.vue'
import AdminDashboard from './Pages/Admin/Dashboard.vue'

document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('app')
    if (!el) return

    // Lire le rôle ET l'utilisateur depuis le HTML (pas depuis window)
    const role = el.dataset.role || 'citoyen'
    window.authUser = JSON.parse(el.dataset.user || '{}')
    window.dashboardStats = JSON.parse(el.dataset.stats || '{"en_attente":0,"validee":0,"rejetee":0}')

    const pages = {
        'citoyen': CitoyenDashboard,
        'agent':   AgentDashboard,
        'admin':   AdminDashboard,
    }

    createApp(pages[role]).mount(el)
})