#!/usr/bin/env python3
import json
import re

# Lire le fichier actuel
with open('backend/src/DataFixtures/data/projects.json', 'r', encoding='utf-8') as f:
    data = json.load(f)

def parse_html_to_blocks(html, default_image=None):
    """Parse le HTML en blocs alternés texte/image"""
    if not html:
        return []
    
    blocks = []
    
    # Découper par <h4>
    parts = html.split('<h4>')
    
    # Le premier morceau (avant le premier h4) - contenu intro
    intro = parts[0] if parts else ''
    
    # Les autres parties sont les sections avec h4
    sections = parts[1:] if len(parts) > 1 else []
    
    # Si pas de h4, créer un seul bloc avec tout le contenu
    if not sections and intro.strip():
        blocks.append({
            'type': 'text_image',
            'layout': 'image_left',
            'image': default_image,
            'content': intro.strip()
        })
        return blocks
    
    for i, section in enumerate(sections):
        # Extraire titre et contenu
        match = re.match(r'^(.*?)</h4>(.*)', section, re.DOTALL)
        if match:
            title = match.group(1).strip()
            content = match.group(2).strip()
            
            # Alterner image gauche/droite
            layout = 'image_left' if i % 2 == 0 else 'image_right'
            
            blocks.append({
                'type': 'text_image',
                'layout': layout,
                'image': default_image,
                'content': f'<h4>{title}</h4>{content}'
            })
    
    return blocks

# Transformer chaque projet
for project in data['projects']:
    # Créer la structure content avec sections
    content = {
        'sections': []
    }
    
    # Section Challenge
    if project.get('challenge'):
        content['sections'].append({
            'type': 'challenge',
            'title': 'Contexte et Problématique',
            'bgColor': 'white',
            'blocks': parse_html_to_blocks(project['challenge'], project.get('challengeImage'))
        })
    
    # Section Solution
    if project.get('solution'):
        content['sections'].append({
            'type': 'solution',
            'title': 'Solution Technique Développée',
            'bgColor': 'gray',
            'blocks': parse_html_to_blocks(project['solution'], project.get('solutionImage'))
        })
    
    # Section Results
    if project.get('results'):
        content['sections'].append({
            'type': 'results',
            'title': 'Résultats et Livrables',
            'bgColor': 'gradient',
            'blocks': parse_html_to_blocks(project['results'], project.get('resultsImage'))
        })
    
    # Ajouter le champ content
    project['content'] = content

# Sauvegarder
with open('backend/src/DataFixtures/data/projects.json', 'w', encoding='utf-8') as f:
    json.dump(data, f, ensure_ascii=False, indent=2)

print("✓ Projects transformés en structure de blocs")
print(f"  {len(data['projects'])} projets mis à jour")
for p in data['projects']:
    sections_count = len(p['content']['sections'])
    blocks_count = sum(len(s['blocks']) for s in p['content']['sections'])
    print(f"  - {p['title']}: {sections_count} sections, {blocks_count} blocs")
