# ValueSuggest

Adds auto-suggest data types to resource templates using controlled vocabulary services.

See the [Omeka S user manual](http://omeka.org/s/docs/user-manual/modules/valuesuggest/) for user documentation.

## Installation

See general end user documentation for [Installing a module](http://omeka.org/s/docs/user-manual/modules/#installing-modules)

## Upgrades

### Version 1.15.0

In version 1.15.0, we have removed the [Dutch Digital Heritage Network of Terms](https://termennetwerk.netwerkdigitaalerfgoed.nl/) vocabularies. These are the resource template data types beginning with "NDE: ". If you are currently using these vocabularies, or want to use them in the future, please download and install the [NdeTermennetwerk](https://omeka.org/s/modules/NdeTermennetwerk/) module.

## Vocabularies

This module includes the following vocabularies:

- Dublin Core
- GeoNames
- The Getty Vocabularies
- Homosaurus
- IdRef
- Library of Congress Linked Data Service
- Nomenclature
- OCLC Metadata Services
- Omeka
- ORCID
- PACTOLS of Frantiq
- PeriodO
- RDA Value Vocabularies
- RightsStatements.org
- Tesauros del patrimonio cultural de España
- UNESCO

### [Dublin Core](https://www.dublincore.org/specifications/dublin-core/dcmi-terms/) (DCMI Metadata Terms)

- Classes
- Elements
- Terms
- Types

### [Gemeinsame Normdatei (GND)](http://lobid.org/gnd)

- The GND contains standardized entries for persons, corporations, congresses, geographical areas, key words and work titles.

### [GeoNames](http://www.geonames.org/)

- The GeoNames geographical database
- GeoNames features

### [The Getty Vocabularies](http://vocab.getty.edu/)

- Art & Architecture Thesaurus (AAT)
- Thesaurus of Geographic Names (TGN)
- Union List of Artist Names (ULAN)
- Cultural Objects Name Authority (CONA)
- Getty Iconography Authority (IA)

### [Homosaurus](http://homosaurus.org/)

- Homosaurus.org linked data vocabulary

### [IdRef](https://www.idref.fr/)

- The French national database of identifiers for research (all repositories)
- Person names
- Corporations
- Conferences
- Subject headings (all)
- Subject headings [RAMEAU](https://rameau.bnf.fr), (Répertoire d’autorité-matière encyclopédique et alphabétique unifié, or Unified encyclopaedic and alphabetical list of subject authorities)
- Subject headings [F-MeSH](http://mesh.inserm.fr/FrenchMesh) (French version of the medical subject headings)
- Geographic names
- Family names
- Titles
- Author-Titles
- Trademarks
- PPN (unique identifier used for any item in all the database)
- Libraries (RCR: Répertoire des centres de ressources)

### [Library of Congress Linked Data Service](http://id.loc.gov/)

- AFS Ethnographic Thesaurus
- All
- Children's Subject Heading
- Classification
- Cultural Heritage Organizations
- Demographic Group Terms
- Genre/Form Terms
- ISO639-1 Languages
- ISO639-2 Languages
- ISO639-5 Languages
- MARC Countries
- MARC Geographic Areas
- MARC Languages
- MARC Relators
- Medium of Performance Thesaurus for Music
- Name Authority File
- Rare Materials Cataloging
- Subject Headings
- Thesaurus for Graphic Materials

### [Nomenclature for Museum Cataloging](https://page.nomenclature.info/apropos-about.app?lang=en)

- All
- Category 01: Built Environment Objects
- Category 02: Furnishings
- Category 03: Personal Objects
- Category 04: Tools & Equipment for Materials
- Category 05: Tools & Equipment for Science & Technology
- Category 06: Tools & Equipment for Communication
- Category 07: Distribution & Transportation Objects
- Category 08: Communication Objects
- Category 09: Recreational Objects
- Category 10: Unclassifiable Objects

### [Nuovo Soggettario](https://thes.bncf.firenze.sbn.it/)

- Agenti: Organismi
- Agenti: Organizzazioni
- Agenti: Persone e gruppi
- Azioni: Attività
- Azioni: Discipline
- Azioni: Processi
- Cose: Forme
- Cose: Materia
- Cose: Oggetti
- Cose: Spazio
- Cose: Strumenti
- Cose: Strutture
- Tempo

### [OCLC Metadata Services](https://www.oclc.org/en/services/a-z.html/:F2664:/)

- Faceted Application of Subject Terminologies (FAST)
- The Virtual International Authority File (VIAF)

### Omeka

Suggest values that already exist in the working Omeka installation.

- Omeka: Property: suggest values using the current property's values
- Omeka: Property / Resource template: suggest values using the current property's values and current resource's template
- Omeka: Property / Resource class: suggest values using the current property's values and current resource's class

### [ORCID](https://info.orcid.org/)

- Open Researcher and Contributor ID

### [PACTOLS of Frantiq](https://pactols.frantiq.fr/)

- The entire pactols thesaurus
- The subject group only

### [PeriodO](http://perio.do/en/)

- A gazetteer of period definitions for linking and visualizing data

### [RDA Value Vocabularies](http://www.rdaregistry.info/termList/)

#### RDA Reference value vocabularies

- Aspect Ratio Designation
- Bibliographic Format
- Broadcast Standard
- Carrier Extent Unit
- Carrier Type
- Cartographic Data Type
- Collection Accrual Method
- Collection Accrual Policy
- Colour Content
- Configuration of Playback Channels
- Content Type
- Extension Plan
- Conventional Collective Title
- File Type
- Font Size
- Form of Musical Notation
- Form of Notated Movement
- Form of Tactile Notation
- Format of Notated Music
- Frequency
- Generation
- Groove Pitch of an Analog Cylinder
- Groove Width of an Analog Disc
- Illustrative Content
- Interactivity Mode
- Layout
- Linked Data Work
- Material
- Media Type
- Mode of Issuance
- Polarity
- Presentation Format
- Production Method
- Recording Medium
- Recording Methods
- Recording Sources
- Reduction Ratio Designation
- Regional Encoding
- Scale Designation
- Sound Content
- Special Playback Characteristics
- Status of Identification
- Terms
- Track Configuration
- Type Of Binding
- Type of Recording
- Unit of Time
- User Tasks
- Video Format

#### RDA Local value vocabularies

- Gender

#### RDA/ONIX Framework value vocabularies

- Character
- Extension Mode
- Extension Requirement
- Extension Termination
- Housing Format
- Image Dimensionality
- Image Movement
- Interaction
- Intermediation Tool
- Revision Mode
- Revision Requirement
- Revision Termination
- Sensory Mode
- Storage Medium Format

### [RightsStatements.org](https://rightsstatements.org/)

- Provides a set of standardized rights statements for cultural heritage institutions that can be used to communicate the copyright and re-use status of digital objects to the public

### [ROR](https://ror.org/)

- Research Organization Registry

### [Tesauros del patrimonio cultural de España](http://tesauros.mecd.es/tesauros)

- Diccionario de Bienes Culturales
- Diccionario de Materias
- Diccionario de Técnicas
- Diccionario de Contextos Culturales
- Diccionario Geográfico
- Diccionario de Toponimia Histórica
- Diccionario de Cerámica
- Diccionario de Numismática
- Diccionario de Mobiliario

### [UNESCO](http://skos.um.es/)

- Tesauro
- Nomenclatura de Ciencia y Tecnología
- Biblioteca Digital Floridablanca

### [Les vocabulaires du Ministère de la Culture](http://data.culture.fr/thesaurus/)

- Catégories techniques et domaines - Inventaire/MH
- Domaines archivistiques pour l'indexation des circulaires
- Etat de conservation du patrimoine mobilier - Inventaire/MH
- Inscriptions, marques, emblématique et poinçons - Inventaire/MH
- Liste d'autorité Actions pour l'indexation des archives locales
- Liste d'autorité Contexte historique pour l'indexation des archives locales
- Liste d'autorité Typologie documentaire pour l'indexation des archives locales
- Liste d'autorités Auteurs - Joconde
- Liste d'autorités Domaines - Joconde
- Liste d'autorités Découverte - Joconde
- Liste d'autorités Dénomination - Joconde
- Liste d'autorités Genèse - Joconde
- Liste d'autorités Inscriptions - Joconde
- Liste d'autorités Lieux - Joconde
- Liste d'autorités Localisation - Joconde
- Liste d'autorités Périodes - Joconde
- Liste d'autorités Représentation - Joconde
- Liste d'autorités Sources de la représentation - Joconde
- Liste d'autorités Techniques – Joconde
- Liste d'autorités Utilisation - Joconde
- Liste d'autorités Écoles - Joconde
- Liste d'autorités Époques - Joconde
- Matériau de la couverture - Inventaire/MH
- Matériau du gros-oeuvre et mise en oeuvre - Inventaire/MH
- Matériaux et techniques du patrimoine mobilier - Inventaire/MH
- Nomenclatures HADOC
- Référentiel de communicabilité des archives publiques
- Stade de la création des objets mobiliers - Inventaire/MH
- Statut de la propriété des Biens culturels - Inventaire/MH
- Techniques photographiques
- Thésaurus de la désignation des objets mobiliers
- Thésaurus de la désignation des œuvres architecturales et des espaces aménagés
- Thésaurus-matières pour l'indexation des archives locales
- Type de la couverture - Inventaire/MH
- Type de protection MH - Inventaire/MH
- Vocabulaire des activités des entités productrices d'archives
- Vocabulaire des altérations
- Vocabulaire des domaines d'action ou objets des entités productrices d'archives
- Vocabulaire pour les techniques photographiques

# Copyright

ValueSuggest is Copyright © 2017-present Corporation for Digital Scholarship, Vienna, Virginia, USA http://digitalscholar.org

The Corporation for Digital Scholarship distributes the Omeka source code
under the GNU General Public License, version 3 (GPLv3). The full text
of this license is given in the license file.

The Omeka name is a registered trademark of the Corporation for Digital Scholarship.

Third-party copyright in this distribution is noted where applicable.

All rights not expressly granted are reserved.
