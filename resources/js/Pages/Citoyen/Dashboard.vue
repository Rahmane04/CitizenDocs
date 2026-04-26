<template>
  <MainLayout :user="user">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">
        Bonjour 👋
      </h1>
      <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4 text-center">
          <p class="text-3xl font-bold text-blue-600">0</p>
          <p class="text-gray-500 mt-1">Demandes en attente</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
          <p class="text-3xl font-bold text-green-600">0</p>
          <p class="text-gray-500 mt-1">Demandes validées</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
          <p class="text-3xl font-bold text-red-600">0</p>
          <p class="text-gray-500 mt-1">Demandes rejetées</p>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
</script>