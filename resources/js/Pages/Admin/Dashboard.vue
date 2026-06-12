<template>
  <div class="flex min-h-screen bg-slate-50">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-full">
      <!-- Logo -->
      <div class="p-6 border-b border-slate-200">
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 bg-sky-600 rounded-xl flex items-center justify-center">
            <span class="text-white font-black text-sm">C</span>
          </div>
          <div>
            <p class="font-bold text-slate-800 text-sm">CitizenDocs</p>
            <p class="text-xs text-slate-400">Panel Admin</p>
          </div>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 p-4 space-y-1">
        <a href="/admin/dashboard"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-sky-50 text-sky-700">
          <span class="text-lg">📊</span> Dashboard
        </a>
        <a href="/admin/users"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
          <span class="text-lg">👥</span> Utilisateurs
        </a>
        <a href="/admin/type-documents"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
          <span class="text-lg">📄</span> Types documents
        </a>
        <a href="/admin/rapports"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
          <span class="text-lg">📈</span> Rapports
        </a>
        <a href="/admin/agents/create"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
          <span class="text-lg">➕</span> Ajouter agent
        </a>
      </nav>

      <!-- Profil -->
      <div class="p-4 border-t border-slate-200">
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-sm">
            {{ user?.prenom?.[0] }}{{ user?.nom?.[0] }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-slate-700 truncate">{{ user?.prenom }} {{ user?.nom }}</p>
            <p class="text-xs text-slate-400">Administrateur</p>
          </div>
          <form method="POST" action="/logout">
            <input type="hidden" name="_token" :value="csrfToken">
            <button type="submit" class="text-xs text-red-500 hover:text-red-700">
              Quitter
            </button>
          </form>
        </div>
      </div>
    </aside>

    <!-- Contenu principal -->
    <main class="ml-64 flex-1 p-8">

      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Tableau de bord</h1>
        <p class="text-slate-500 text-sm mt-1">Bienvenue, {{ user?.prenom }} — vue d'ensemble de CitizenDocs</p>
      </div>

      <!-- Cartes stats -->
      <div class="grid grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-5">
          <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Total demandes</p>
          <p class="text-3xl font-bold text-slate-800">{{ stats.total_demandes }}</p>
          <p class="text-xs text-sky-600 mt-2 font-medium">📋 Toutes périodes</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5">
          <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Citoyens</p>
          <p class="text-3xl font-bold text-slate-800">{{ stats.total_citoyens }}</p>
          <p class="text-xs text-emerald-600 mt-2 font-medium">👤 Inscrits</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5">
          <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Agents</p>
          <p class="text-3xl font-bold text-slate-800">{{ stats.total_agents }}</p>
          <p class="text-xs text-purple-600 mt-2 font-medium">👔 Actifs</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5">
          <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Paiements</p>
          <p class="text-2xl font-bold text-slate-800">{{ formatMontant(stats.total_paiements) }}</p>
          <p class="text-xs text-orange-600 mt-2 font-medium">💰 FCFA collectés</p>
        </div>
      </div>

      <!-- Graphiques -->
      <div class="grid grid-cols-2 gap-5 mb-8">
        <!-- Demandes par statut -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
          <h2 class="text-base font-semibold text-slate-700 mb-4">Demandes par statut</h2>
          <canvas id="chartStatut" height="200"></canvas>
        </div>

        <!-- Paiements par mois -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
          <h2 class="text-base font-semibold text-slate-700 mb-4">Paiements par mois</h2>
          <canvas id="chartPaiements" height="200"></canvas>
        </div>
      </div>

      <!-- Actions rapides -->
      <div class="grid grid-cols-3 gap-5">
        <a href="/admin/users"
           class="bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-md transition flex items-center gap-4">
          <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center text-2xl">👥</div>
          <div>
            <p class="font-semibold text-slate-700">Gérer utilisateurs</p>
            <p class="text-xs text-slate-400">Activer / désactiver</p>
          </div>
        </a>
        <a href="/admin/type-documents"
           class="bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-md transition flex items-center gap-4">
          <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">📄</div>
          <div>
            <p class="font-semibold text-slate-700">Types documents</p>
            <p class="text-xs text-slate-400">Configurer les types</p>
          </div>
        </a>
        <a href="/admin/rapports"
           class="bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-md transition flex items-center gap-4">
          <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-2xl">📈</div>
          <div>
            <p class="font-semibold text-slate-700">Rapports</p>
            <p class="text-xs text-slate-400">Statistiques détaillées</p>
          </div>
        </a>
      </div>

    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Chart from 'chart.js/auto'

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
const user = ref(window.authUser || null)
const stats = ref(window.dashboardStats || {
  total_demandes: 0,
  total_citoyens: 0,
  total_agents: 0,
  total_paiements: 0,
  demandes_par_statut: [],
  paiements_par_mois: []
})

function formatMontant(val) {
  return new Intl.NumberFormat('fr-FR').format(val || 0)
}

onMounted(() => {
  // Graphique demandes par statut
  const statutData = stats.value.demandes_par_statut || []
  new Chart(document.getElementById('chartStatut'), {
    type: 'doughnut',
    data: {
      labels: statutData.map(s => s.statut),
      datasets: [{
        data: statutData.map(s => s.total),
        backgroundColor: ['#f59e0b', '#0ea5e9', '#10b981', '#ef4444'],
        borderWidth: 0,
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } }
    }
  })

  // Graphique paiements par mois
  const paiementsData = stats.value.paiements_par_mois || []
  const moisLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc']
  new Chart(document.getElementById('chartPaiements'), {
    type: 'line',
    data: {
      labels: paiementsData.map(p => moisLabels[p.mois - 1] || p.mois),
      datasets: [{
        label: 'Paiements (FCFA)',
        data: paiementsData.map(p => p.total),
        borderColor: '#0ea5e9',
        backgroundColor: 'rgba(14, 165, 233, 0.1)',
        borderWidth: 2,
        fill: true,
        tension: 0.4,
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
        x: { grid: { display: false } }
      }
    }
  })
})
</script>