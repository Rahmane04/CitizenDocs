<template>
  <MainLayout>
    <div class="max-w-5xl mx-auto">

      <!-- En-tête -->
      <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Tableau de bord</h1>
        <p class="text-slate-500 text-sm mt-1">Bienvenue, {{ user?.prenom }} {{ user?.nom }}</p>
      </div>

      <!-- Cartes statistiques -->
      <div class="grid grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition">
          <div class="flex justify-between items-start mb-4">
            <p class="text-sm font-medium text-slate-500">En attente</p>
            <span class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600 text-sm">⏳</span>
          </div>
          <p class="text-3xl font-bold text-slate-800">{{ stats.en_attente }}</p>
          <p class="text-xs text-amber-600 mt-2 font-medium">En cours de traitement</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition">
          <div class="flex justify-between items-start mb-4">
            <p class="text-sm font-medium text-slate-500">Validées</p>
            <span class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 text-sm">✅</span>
          </div>
          <p class="text-3xl font-bold text-slate-800">{{ stats.validee }}</p>
          <p class="text-xs text-emerald-600 mt-2 font-medium">Documents disponibles</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition">
          <div class="flex justify-between items-start mb-4">
            <p class="text-sm font-medium text-slate-500">Rejetées</p>
            <span class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center text-red-500 text-sm">❌</span>
          </div>
          <p class="text-3xl font-bold text-slate-800">{{ stats.rejetee }}</p>
          <p class="text-xs text-red-500 mt-2 font-medium">Voir les motifs</p>
        </div>
      </div>

      <!-- Informations utiles -->
      <div class="grid grid-cols-2 gap-5">
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
          <h2 class="text-base font-semibold text-slate-700 mb-4">📋 Comment ça marche ?</h2>
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
          <h2 class="text-base font-semibold text-slate-700 mb-4">📄 Documents disponibles</h2>
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