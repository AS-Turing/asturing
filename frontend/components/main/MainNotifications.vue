<script setup lang="ts">
const { notifications } = useNotifications()
</script>

<template>
  <aside class="fixed inset-x-0 bottom-0 z-50 md:bottom-2 md:left-auto md:right-2">
    <TransitionGroup
        class="flex flex-col md:gap-3"
        enter-active-class="transition-all ease-in-out duration-500"
        enter-from-class="opacity-0 translate-y-0"
        leave-active-class="transition-all ease-in-out duration-500"
        leave-to-class="opacity-0 translate-y-0"
        move-class="transition-all ease-in-out duration-500"
        name="snackbar"
        tag="div"
    >
      <MainSnackbar
          v-for="notification in notifications"
          :key="notification.id"
          :notification
      />
    </TransitionGroup>
  </aside>
</template>
