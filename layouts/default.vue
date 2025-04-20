<template>
  <div class="flex min-h-screen flex-col bg-white dark:bg-primary">
    <MainHeader />
    <main class="flex-1">
      <slot />
    </main>
    <MainFooter />
  </div>
</template>
