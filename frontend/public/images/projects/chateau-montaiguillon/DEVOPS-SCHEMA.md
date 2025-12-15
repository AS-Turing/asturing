# Infrastructure DevOps - Montaiguillon

```
┌────────────────────────────────────────────────────────────────────────────────────────────┐
│                                FLUX DE DÉPLOIEMENT AUTOMATISÉ                              │
└────────────────────────────────────────────────────────────────────────────────────────────┘

                                                                             ┌──────────────┐
                                                                ┌─────3─────>│     TEST     │
                                                                │            │  dev.site    │
┌──────────────┐            ┌──────────────┐            ┌───────┴──┐         │  Docker      │
│     LOCAL    │            │    GITHUB    │            │  CI/CD   │         │  MySQL       │
│              │ ────1────> │              │ ────2────> │          │         └──────────────┘
│  Dev code    │            │  Stockage    │            │  Tests   │                     
│              │            │  Versioning  │            │  Build   │        ┌──────────────┐
└──────────────┘            └──────────────┘            └───────┬──┘        │     PROD     │
                                                                └────4─────>│  site.com    │
                                                                            │  Docker      │
                                                                            │  MySQL       │
                                                                            │  Backup      │
                                                                            └──────────────┘

┌──────────────────────────────────────────────┐   ┌──────────────────────────────────────────┐
│           TECHNOLOGIES CLÉS                  │   │              AVANT / APRÈS               │
└──────────────────────────────────────────────┘   └──────────────────────────────────────────┘
CI/CD           DOCKER        GITHUB                    SANS DEVOPS           AVEC DEVOPS
─────────       ──────────    ──────────                ───────────────       ──────────────
• Tests auto    • Isolation   • Versioning              Deploy 2-3h           Deploy 5min
• Build auto    • Stabilité   • Historique              Tests manuels         Tests auto
• Deploy auto   • Reproductib • Traçabili               Erreurs humaines      Processus fiable
• Sécurité      • Sans coupure• Rollback                Site offline          Toujours en ligne
                                                        Pas de backup         Backup auto
```
