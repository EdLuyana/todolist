# Gestionnaire de Projets et de Tâches

## Description
Cette application permet de gérer des projets et leurs tâches associées. Elle est simple et ne nécessite pas de système d'authentification pour l'instant. Les utilisateurs peuvent organiser des projets, ajouter des tâches avec des relations hiérarchiques (sous-tâches), et attribuer des tags pour catégoriser les projets.

---

## Objectifs
- Créer et gérer des projets.
- Gérer les tâches associées à chaque projet.
- Supporter la hiérarchie des tâches (tâches parentes et sous-tâches).
- Associer des tags aux projets pour une meilleure organisation.
- Gérer les statuts des tâches à l’aide d’une table dédiée.
- Automatiser les validations entre tâches parentes et sous-tâches.

---

## Fonctionnalités

### Tags
- **Créer un tag** : Ajouter un nouveau tags.
- **Lister les tags** : Voir tous les tags.
- **Supprimer un tags** : Supprimer un tag.


### Projets
- **Créer un projet** : Ajouter un nouveau projet.
- **Lister les projets** : Voir tous les projets créés.
- **Voir les détails d’un projet** : Consulter les informations d’un projet.
- **Supprimer un projet** : Supprimer un projet.
- **Associer des tags à un projet** : Permettre de catégoriser les projets.

### Tâches
- **Créer une tâche** : Ajouter une tâche à un projet.
- **Associer une tâche à un projet** : Une tâche appartient obligatoirement à un projet.
- **Créer une sous-tâche** : Ajouter une tâche enfant à une tâche existante.
- **Gérer les relations parent-enfant** :
    - Valider une tâche parente valide automatiquement toutes ses sous-tâches.
    - Valider toutes les sous-tâches valide automatiquement leur tâche parente.
- **Modifier une tâche** : Modifier le titre, la description ou le statut d’une tâche.
- **Supprimer une tâche** : Supprimer une tâche, ce qui supprime également ses sous-tâches.

### Statuts
- **Statut des tâches** :
    - Les statuts possibles sont stockés dans une table `status` (ex. : "À faire", "En cours", "Terminée").
    - Une tâche peut changer de statut manuellement ou automatiquement selon les règles métier (validation des tâches parentes et sous-tâches).

### Tags
- **Associer des tags aux projets** : Un projet peut avoir plusieurs tags.
- **Lister les projets par tags** : Afficher les projets associés à un tag spécifique.

---

## Modèles de données

### Projet (Project)
- `id` : Identifiant unique.
- `name` : Nom du projet.
- `description` : Description du projet.
- `image` : Image du projet.
- `createdAt` : Date de création.

### Tâche (Task)
- `id` : Identifiant unique.
- `title` : Titre de la tâche.
- `description` : Description de la tâche.
- `project_id` : Référence au projet auquel appartient la tâche.
- `parent_id` : Référence à une tâche parente (relation hiérarchique).
- `status_id` : Référence au statut de la tâche.
- `priority_id` : Référence aà la priorité de la tâche.
- `createdAt` : Date de création.

### Statut (Status)
- `id` : Identifiant unique.
- `name` : Nom du statut ("À faire", "En cours", "Terminée").

### Tag
- `id` : Identifiant unique.
- `name` : Nom du tag.

### Priority
- `id` : Identifiant unique.
- `name` : Nom de la priorité ("Basse", "Normal", "Haute", "Urgente").
- `level` : Niveau de priorité ("Basse" => 1, "Normal" => 2, "Haute" => 3, "Urgente" => 4).
