import './bootstrap.js'
import { createApp } from 'vue'

import CitoyenDashboard from './Pages/Citoyen/Dashboard.vue'
import AgentDashboard from './Pages/Agent/Dashboard.vue'
import AdminDashboard from './Pages/Admin/Dashboard.vue'

document.addEventListener('DOMContentLoaded', () => {
    const role = window.authUser?.role || 'citoyen'

    const pages = {
        'citoyen': CitoyenDashboard,
        'agent':   AgentDashboard,
        'admin':   AdminDashboard,
    }

    const el = document.getElementById('app')
    if (el) {
        createApp(pages[role]).mount(el)
    }
})