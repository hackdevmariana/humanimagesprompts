## ADDED Requirements

### Requirement: Pose compiler uses body_language_en
The `PromptCompiler::poseText()` method SHALL prefer `body_language_en` over `body_language` when building the pose prompt segment.

#### Scenario: Uses EN field when present
- **WHEN** pose data has `body_language_en: "Standing, relaxed posture"` AND `body_language: "De pie, postura relajada"`
- **THEN** compiled pose text contains `"Standing, relaxed posture"`

#### Scenario: Falls back to ES when EN absent
- **WHEN** pose data has only `body_language: "De pie, postura relajada"`
- **THEN** compiled pose text contains `"De pie, postura relajada"`

### Requirement: Scene compiler uses location_details_en
The `PromptCompiler::sceneText()` method SHALL prefer `location_details_en` over `location_details` when building the scene prompt segment.

#### Scenario: Uses EN field when present
- **WHEN** scene data has `location_details_en: "Rooftop with city view, damp grass"` AND `location_details: "Azotea con vista a la ciudad, césped húmedo"`
- **THEN** compiled scene text contains `"Rooftop with city view, damp grass"`

#### Scenario: Falls back to ES when EN absent
- **WHEN** scene data has only `location_details: "Azotea con vista a la ciudad, césped húmedo"`
- **THEN** compiled scene text contains `"Azotea con vista a la ciudad, césped húmedo"`

### Requirement: Makeup compiler uses style_name_en
The `PromptCompiler::characterText()` method SHALL prefer `style_name_en` over `style_name` for makeup style in the prompt.

#### Scenario: Uses EN field when present
- **WHEN** makeup data has `style_name_en: "No-Makeup Natural Glow"` AND `style_name: "Look glow dorado"`
- **THEN** compiled character text contains `"wearing No-Makeup Natural Glow makeup"`

#### Scenario: Falls back to ES when EN absent
- **WHEN** makeup data has only `style_name: "Look glow dorado"`
- **THEN** compiled character text contains `"wearing Look glow dorado makeup"`