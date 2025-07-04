<script setup lang="ts">
import useInView from '@/composables/useInView'

const { notifySuccess, notifyError } = useNotifications()
const { isVisible: showForm, el: formRef } = useInView()
const mailContent = ref({
  firstname: '',
  lastname: '',
  company: '',
  mail: '',
  phone: '',
  message: '',
})

async function sendMail(event: Event) {
  event.preventDefault()
  try {
    const formData = new FormData()
    formData.append('firstname', mailContent.value.firstname)
    formData.append('lastname', mailContent.value.lastname)
    formData.append('company', mailContent.value.company)
    formData.append('mail', mailContent.value.mail)
    formData.append('phone', mailContent.value.phone)
    formData.append('message', mailContent.value.message)

    const response = await fetch('/php-api/mail.php', {
      method: 'POST',
      body: formData,
    })

    const text = await response.text()

    if (response.ok) {
      console.log('Message envoyé !', text)
      notifySuccess("Votre message a bien été transmis avec succès !");
      mailContent.value = {
        firstname: '',
        lastname: '',
        company: '',
        mail: '',
        phone: '',
        message: '',
      }
    } else {
      console.error('Erreur lors de l’envoi :', text)
      notifyError("Une erreur est survenue, veuillez réessayer ou nous contacter directement.")
    }
  } catch (err) {
    console.error('Erreur réseau :', err)
  }
}
</script>

<template>
  <section class="bg-white dark:bg-gray-900 py-8 md:py-16 md:px-4 sm:px-8">
    <div
        ref="formRef"
        :class="[
          'transition-all duration-1000 ease-out transform mx-auto relative z-10',
          showForm ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'
        ]"
        class="max-w-4xl p-6 md:p-12 rounded-2xl border border-gray-200 dark:bg-primary"
    >
      <div id="contact-form" class="text-center mb-12">
        <h2 class="text-4xl sm:text-5xl font-bold text-primary dark:text-white mb-4 underline dark:decoration-secondary underline-offset-8">
          Prenons contact
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-xl mx-auto">
          Un projet, une idée, une question ? Discutons ensemble pour concrétiser vos ambitions numériques.
        </p>
      </div>

      <form class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div :class="['transition-all duration-700 ease-out transform opacity-0 translate-y-4', showForm ? 'opacity-100 translate-y-0 delay-[0ms]' : '']">
          <label for="first-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
          <input id="first-name" v-model="mailContent.lastname" type="text" required autocomplete="given-name"
                 class="mt-2 w-full rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-base text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
        </div>

        <div :class="['transition-all duration-700 ease-out transform opacity-0 translate-y-4', showForm ? 'opacity-100 translate-y-0 delay-[100ms]' : '']">
          <label for="last-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
          <input id="last-name" v-model="mailContent.firstname" type="text" required autocomplete="family-name"
                 class="mt-2 w-full rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-base text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
        </div>

        <div class="sm:col-span-2"
             :class="['transition-all duration-700 ease-out transform opacity-0 translate-y-4', showForm ? 'opacity-100 translate-y-0 delay-[200ms]' : '']">
          <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Entreprise</label>
          <input id="company" v-model="mailContent.company" type="text" autocomplete="organization"
                 class="mt-2 w-full rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-base text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
        </div>

        <div class="sm:col-span-2"
             :class="['transition-all duration-700 ease-out transform opacity-0 translate-y-4', showForm ? 'opacity-100 translate-y-0 delay-[300ms]' : '']">
          <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse e-mail</label>
          <input id="email" v-model="mailContent.mail" type="email" autocomplete="email" required
                 class="mt-2 w-full rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-base text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
        </div>

        <div class="sm:col-span-2"
             :class="['transition-all duration-700 ease-out transform opacity-0 translate-y-4', showForm ? 'opacity-100 translate-y-0 delay-[400ms]' : '']">
          <label for="phone-number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
          <input id="phone-number" v-model="mailContent.phone" type="tel"
                 class="mt-2 w-full rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-base text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
        </div>

        <div class="sm:col-span-2"
             :class="['transition-all duration-700 ease-out transform opacity-0 translate-y-4', showForm ? 'opacity-100 translate-y-0 delay-[500ms]' : '']">
          <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
          <textarea id="message" v-model="mailContent.message" rows="5" required
                    class="mt-2 w-full rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-base text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>
        </div>

        <p class="sm:col-span-2 mt-4 text-sm text-gray-500 dark:text-gray-400">
          Les informations saisies sont utilisées uniquement pour vous recontacter dans le cadre de votre demande.
          Elles ne sont ni stockées, ni transmises à des tiers. Pour toute question, vous pouvez écrire à
          <a href="mailto:alexandre@as-turing.fr" class="underline hover:text-primary">alexandre@as-turing.fr</a>.
        </p>

        <div class="sm:col-span-2 mt-6 flex justify-center"
             :class="['transition-all duration-700 ease-out transform opacity-0 translate-y-4', showForm ? 'opacity-100 translate-y-0 delay-[600ms]' : '']">
          <button
              @click="sendMail"
              class="group inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center border rounded-lg
             text-secondary bg-primary hover:text-primary hover:bg-secondary border-secondary hover:border-primary
             dark:text-primary dark:bg-secondary dark:hover:text-secondary dark:hover:bg-primary dark:border-gray-700
             hover:scale-105 transition-all duration-700 ease-in-out transform focus:ring-4 focus:ring-gray-100 hover:cursor-pointer"
          >
            <Icon name="lucide:send"
                  class="w-5 h-5 transition-all duration-700 group-hover:scale-110 group-hover:rotate-12" />
            <span class="ml-2 transition-all duration-700 group-hover:translate-x-1 font-bold">
              Envie d’échanger sur votre projet ?
            </span>
          </button>
        </div>
      </form>
    </div>
  </section>
</template>
