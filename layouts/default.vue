<template>
  <div class="flex min-h-screen flex-col bg-white dark:bg-gray-900">
    <MainHeader />
    <main class="flex-1">
      <slot />
    </main>
    <MainFooter />
  </div>
</template>
