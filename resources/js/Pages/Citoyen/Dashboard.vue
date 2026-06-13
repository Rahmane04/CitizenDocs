<template>
  <MainLayout>
    <div class="max-w-5xl mx-auto">

      <!-- En-tête -->
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
          <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tableau de bord</h1>
          <p class="text-slate-500 text-sm mt-1">Ravi de vous revoir, {{ user?.prenom }} {{ user?.nom }}</p>
        </div>
        <a href="/citoyen/demandes/create"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 text-white text-sm font-semibold rounded-xl hover:bg-sky-700 active:scale-95 transition-all shadow-md shadow-sky-200 border border-sky-600 hover:shadow-lg">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
          </svg>
          Nouvelle demande
        </a>
      </div>

      <!-- Cartes statistiques -->
      <div class="grid grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition-all duration-300">
          <div class="flex justify-between items-start mb-4">
            <p class="text-sm font-medium text-slate-500">En attente</p>
            <div class="w-8 h-8 bg-amber-50 border border-amber-100 rounded-lg flex items-center justify-center text-amber-600">
              <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            </div>
          </div>
          <p class="text-3xl font-bold text-slate-800">{{ stats.en_attente }}</p>
          <p class="text-xs text-amber-600 mt-2 font-semibold">En cours de traitement</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition-all duration-300">
          <div class="flex justify-between items-start mb-4">
            <p class="text-sm font-medium text-slate-500">Validées</p>
            <div class="w-8 h-8 bg-emerald-50 border border-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
              <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
              </svg>
            </div>
          </div>
          <p class="text-3xl font-bold text-slate-800">{{ stats.validee }}</p>
          <p class="text-xs text-emerald-600 mt-2 font-semibold">Documents disponibles</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition-all duration-300">
          <div class="flex justify-between items-start mb-4">
            <p class="text-sm font-medium text-slate-500">Rejetées</p>
            <div class="w-8 h-8 bg-red-50 border border-red-100 rounded-lg flex items-center justify-center text-red-500">
              <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>
            </div>
          </div>
          <p class="text-3xl font-bold text-slate-800">{{ stats.rejetee }}</p>
          <p class="text-xs text-red-500 mt-2 font-semibold">Voir les motifs</p>
        </div>
      </div>

      <!-- Informations utiles -->
      <div class="grid grid-cols-2 gap-5">
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
          <h2 class="flex items-center gap-2 text-base font-bold text-slate-800 mb-4">
            <svg class="w-5 h-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
            </svg>
            Comment ça marche ?
          </h2>
          <div class="space-y-3">
            <div class="flex items-start gap-3">
              <span class="w-6 h-6 bg-sky-100 rounded-full flex items-center justify-center text-sky-700 text-xs font-bold shrink-0 mt-0.5">1</span>
              <p class="text-sm text-slate-600">Soumettez votre demande de document administratif</p>
            </div>
            <div class="flex items-start gap-3">
              <span class="w-6 h-6 bg-sky-100 rounded-full flex items-center justify-center text-sky-700 text-xs font-bold shrink-0 mt-0.5">2</span>
              <p class="text-sm text-slate-600">Effectuez le paiement via Wave ou Orange Money</p>
            </div>
            <div class="flex items-start gap-3">
              <span class="w-6 h-6 bg-sky-100 rounded-full flex items-center justify-center text-sky-700 text-xs font-bold shrink-0 mt-0.5">3</span>
              <p class="text-sm text-slate-600">Un agent traite votre demande sous quelques jours</p>
            </div>
            <div class="flex items-start gap-3">
              <span class="w-6 h-6 bg-sky-100 rounded-full flex items-center justify-center text-sky-700 text-xs font-bold shrink-0 mt-0.5">4</span>
              <p class="text-sm text-slate-600">Téléchargez votre document une fois validé</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6">
          <h2 class="flex items-center gap-2 text-base font-bold text-slate-800 mb-4">
            <svg class="w-5 h-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            Documents disponibles
          </h2>
          <div class="space-y-2">
            <div class="flex justify-between items-center py-2 border-b border-slate-100">
              <span class="text-sm text-slate-600">Acte de naissance</span>
              <span class="text-xs font-semibold text-sky-700 bg-sky-50 px-2 py-1 rounded-full">1 000 FCFA</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-slate-100">
              <span class="text-sm text-slate-600">Certificat de résidence</span>
              <span class="text-xs font-semibold text-sky-700 bg-sky-50 px-2 py-1 rounded-full">500 FCFA</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-slate-100">
              <span class="text-sm text-slate-600">Casier judiciaire</span>
              <span class="text-xs font-semibold text-sky-700 bg-sky-50 px-2 py-1 rounded-full">2 000 FCFA</span>
            </div>
            <div class="flex justify-between items-center py-2">
              <span class="text-sm text-slate-600">Carte nationale d'identité</span>
              <span class="text-xs font-semibold text-sky-700 bg-sky-50 px-2 py-1 rounded-full">3 000 FCFA</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'

const user = ref(window.authUser || null)
const stats = ref(window.dashboardStats || { en_attente: 0, validee: 0, rejetee: 0 })
</script>