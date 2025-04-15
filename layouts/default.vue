<template>
  <div class="flex min-h-screen flex-col">
    <MainHeader />
    <main class="flex-1">
      <slot />
    </main>
    <MainFooter />
  </div>
</template>
