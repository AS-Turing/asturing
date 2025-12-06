# 🎯 Système d'informations entreprise - AS-Turing

## ✅ Implémentation terminée

Toutes les données de l'entreprise AS-Turing sont maintenant centralisées en base de données et accessibles partout dans le site via un système unifié.

---

## 📦 Ce qui a été créé

### Backend (Symfony)

1. **Entity** : `backend/src/Entity/CompanyInfo.php`
   - Stocke toutes les infos : nom, téléphone, email, adresse, réseaux sociaux, horaires, etc.

2. **Repository** : `backend/src/Repository/CompanyInfoRepository.php`
   - Méthode `findCompanyInfo()` pour récupérer les données

3. **API Controller** : `backend/src/Controller/Api/CompanyInfoController.php`
   - Route : `GET /api/company/info`
   - Retourne JSON avec toutes les informations

4. **Admin CRUD** : `backend/src/Controller/Admin/CompanyInfoCrudController.php`
   - Accessible dans EasyAdmin : Menu "Général" > "Informations entreprise"
   - Interface pour modifier toutes les données

5. **Fixtures** : `backend/src/DataFixtures/CompanyInfoFixtures.php`
   - Données initiales chargées en BDD

6. **Migration** : Créée et exécutée ✅

### Frontend (Nuxt 4)

1. **Type TypeScript** : `frontend/app/types/company.ts`
   - Interface `CompanyInfo` avec typage complet

2. **Composable** : `frontend/app/composables/useCompany.ts`
   - Hook réutilisable : `const { companyInfo } = useCompany()`
   - State global accessible partout

3. **Plugin** : `frontend/app/plugins/company.ts`
   - Charge automatiquement les données au démarrage de l'app
   - Les données sont disponibles immédiatement

4. **API Proxy** : `frontend/server/api/company/info.get.ts`
   - Proxy vers le backend Symfony (Docker-aware)
   - Route : `GET /api/company/info`

5. **Composants mis à jour** :
   - `AppFooter.vue` : Email, téléphone, ville, réseaux sociaux dynamiques
   - `SectionContact.vue` : Email et téléphone dynamiques
   - `ServiceCTA.vue` : Téléphone dynamique dans le bouton CTA
   - `CompanyPhoneButton.vue` : Composant exemple réutilisable
   - `index.vue` : Schema.org avec données dynamiques
   - `index-old.vue` : Email et téléphone dynamiques

6. **Configuration** : `nuxt.config.ts`
   - `apiBase` configuré pour Docker : `http://symfony`

---

## 🚀 Utilisation

### Dans n'importe quel composant Vue

```vue
<template>
  <div>
    <!-- Nom entreprise -->
    <h1>{{ company?.companyName }}</h1>
    
    <!-- Téléphone cliquable -->
    <a 
      v-if="company?.phone" 
      :href="`tel:${company.phone.replace(/\s/g, '')}`"
    >
      {{ company.phone }}
    </a>
    
    <!-- Email -->
    <a 
      v-if="company?.email" 
      :href="`mailto:${company.email}`"
    >
      {{ company.email }}
    </a>
    
    <!-- Adresse -->
    <p>{{ company?.address }}, {{ company?.zipCode }} {{ company?.city }}</p>
    
    <!-- Réseaux sociaux -->
    <a 
      v-if="company?.socialNetworks?.linkedin" 
      :href="company.socialNetworks.linkedin"
      target="_blank"
    >
      LinkedIn
    </a>
  </div>
</template>

<script setup lang="ts">
const { companyInfo: company } = useCompany()
</script>
```

### Données disponibles

```typescript
interface CompanyInfo {
  id: number
  companyName: string           // "AS-Turing"
  tagline?: string              // Slogan
  description?: string          // Description courte
  phone?: string                // "05 56 XX XX XX"
  email: string                 // "contact@as-turing.fr"
  address?: string              // Adresse complète
  city?: string                 // "Libourne"
  zipCode?: string              // "33500"
  region?: string               // "Nouvelle-Aquitaine"
  country?: string              // "France"
  socialNetworks?: {
    github?: string
    linkedin?: string
    twitter?: string
    facebook?: string
  }
  logoPath?: string             // "/images/logo2.png"
  siret?: string                // SIRET
  tva?: string                  // N° TVA
  businessHours?: {
    monday?: { open: string; close: string } | null
    // ... autres jours
  }
}
```

---

## 🔧 Modification des données

### Via l'admin EasyAdmin

1. **Accéder à l'admin** : http://localhost:8082/admin
2. **Menu** : Général > Informations entreprise
3. **Modifier** les champs souhaités
4. **Sauvegarder**
5. Les changements sont immédiatement visibles (après rechargement page)

### Via fixtures (dev)

Modifier `backend/src/DataFixtures/CompanyInfoFixtures.php` puis :

```bash
docker compose exec symfony php bin/console doctrine:fixtures:load --append
```

---

## 🎨 Composants mis à jour

### AppFooter
- Nom entreprise dynamique
- Email dynamique avec lien mailto
- Téléphone dynamique avec lien tel (nouveau !)
- Ville et pays dynamiques
- Réseaux sociaux dynamiques (affichés uniquement si renseignés)

### SectionContact
- Email cliquable dynamique
- Téléphone cliquable dynamique

### ServiceCTA
- Bouton téléphone avec numéro dynamique

### Page index.vue
- Schema.org LocalBusiness avec données dynamiques :
  - Nom, email, téléphone
  - Adresse complète (ville, code postal, région)
  - Réseaux sociaux
- Schema.org ProfessionalService avec nom et tagline dynamiques

---

## ✅ Tests effectués

- ✅ Migration BDD créée et appliquée
- ✅ Fixtures chargées
- ✅ API backend testée : `http://localhost:8082/api/company/info`
- ✅ API frontend testée : `http://localhost:3001/api/company/info`
- ✅ Données accessibles via `useCompany()`
- ✅ Footer mis à jour et fonctionnel
- ✅ SectionContact mis à jour
- ✅ ServiceCTA mis à jour
- ✅ Schema.org mis à jour
- ✅ Admin EasyAdmin configuré

---

## 📝 Notes importantes

1. **Environnement Docker** : Le frontend Nuxt utilise `http://symfony` pour communiquer avec le backend (réseau Docker)

2. **State global** : Les données sont chargées une seule fois au démarrage de l'app via le plugin

3. **Réactivité** : Si les données changent en BDD, il faut recharger la page pour voir les changements

4. **Fallbacks** : Tous les composants ont des valeurs par défaut si les données ne sont pas disponibles

5. **Types** : TypeScript garantit la sécurité des types partout

6. **Performance** : Un seul appel API au démarrage, ensuite les données sont en cache global

---

## 🎯 Prochaines étapes suggérées

- [ ] Mettre à jour le Header pour utiliser `company.logoPath`
- [ ] Créer un composant `CompanyAddress` réutilisable
- [ ] Ajouter les horaires d'ouverture dans le footer ou contact
- [ ] Utiliser `company.siret` et `company.tva` dans les mentions légales
- [ ] Créer des Schema.org structurés supplémentaires avec les données entreprise

---

## 📊 Fichiers modifiés

### Backend (7 fichiers)
- ✅ `src/Entity/CompanyInfo.php` (nouveau)
- ✅ `src/Repository/CompanyInfoRepository.php` (nouveau)
- ✅ `src/Controller/Api/CompanyInfoController.php` (nouveau)
- ✅ `src/Controller/Admin/CompanyInfoCrudController.php` (nouveau)
- ✅ `src/Controller/Admin/DashboardController.php` (modifié)
- ✅ `src/DataFixtures/CompanyInfoFixtures.php` (nouveau)
- ✅ `migrations/Version20251206124347.php` (nouveau)

### Frontend (11 fichiers)
- ✅ `app/types/company.ts` (nouveau)
- ✅ `app/composables/useCompany.ts` (nouveau)
- ✅ `app/plugins/company.ts` (nouveau)
- ✅ `server/api/company/info.get.ts` (nouveau)
- ✅ `app/components/AppFooter.vue` (modifié)
- ✅ `app/components/CompanyPhoneButton.vue` (nouveau - exemple)
- ✅ `app/components/sections/SectionContact.vue` (modifié)
- ✅ `app/components/service/ServiceCTA.vue` (modifié)
- ✅ `app/pages/index.vue` (modifié)
- ✅ `app/pages/index-old.vue` (modifié)
- ✅ `nuxt.config.ts` (modifié)

---

**Système créé le** : 6 décembre 2024  
**Testé et fonctionnel** : ✅  
**Tous les emails et téléphones en dur remplacés** : ✅

