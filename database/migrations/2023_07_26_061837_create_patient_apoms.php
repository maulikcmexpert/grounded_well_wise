<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_apoms', function (Blueprint $table) {

            // Occupational Therapy Screening on Admission

            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('patientName')->nullable();
            $table->date('dateOfScreening')->nullable();
            $table->string('idNumber')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('therapistName')->nullable();
            $table->string('age')->nullable();
            $table->string('duration')->nullable();
            $table->string('psychiatrist')->nullable();
            $table->string('place')->nullable();
            $table->string('psychologist')->nullable();

            // History

            $table->text('prev_add_diagnosis')->nullable();
            $table->string('compliance_followup')->nullable();
            $table->string('complaint')->nullable();
            $table->text('medicalConditions')->nullable();

            //  Personal life / Family

            $table->string('relationshipStatus')->nullable();
            $table->string('partnerName')->nullable();
            $table->string('durationOfRelationship')->nullable();
            $table->text('qualityOfRelationship')->nullable();
            $table->text('childrenDependants')->nullable();
            $table->text('livingArrangements')->nullable();
            $table->text('qualityOfRelationshipsInFamily')->nullable();
            $table->text('familyStressorsConflict')->nullable();
            $table->text('supportSystem')->nullable();
            $table->text('nextOfKinContact')->nullable();

            // Work Situation

            $table->text('jobTitle')->nullable();
            $table->text('employer')->nullable();
            $table->text('yearsInJob')->nullable();
            $table->text('jobSatisfaction')->nullable();
            $table->text('jobRole')->nullable();
            $table->text('strugglingWith')->nullable();
            $table->text('otherInfo')->nullable();

            // Free Time

            $table->text('hobbiesLeisure')->nullable();
            $table->text('mood')->nullable();
            $table->text('coping')->nullable();
            $table->text('substanceYesNo')->nullable();
            $table->text('substance1')->nullable();
            $table->text('substance1Frequency')->nullable();
            $table->text('substance1LastUse')->nullable();
            $table->text('substance2')->nullable();
            $table->text('substance2Frequency')->nullable();
            $table->text('substance2LastUse')->nullable();
            $table->text('substance3')->nullable();
            $table->text('substance3Frequency')->nullable();
            $table->text('substance3LastUse')->nullable();
            $table->text('substance4')->nullable();
            $table->text('substance4Frequency')->nullable();
            $table->text('substance4LastUse')->nullable();
            $table->text('cutDown')->nullable();
            $table->text('peopleAnnoyed')->nullable();
            $table->text('feltBadGuilty')->nullable();
            $table->text('drinkUsedMorning')->nullable();
            $table->text('expectationsGoals')->nullable();

            // Apom List //

            // Process Skill //

            $table->text('attention')->nullable();
            $table->text('pace')->nullable();
            $table->text('knowledgeToolsAndMaterials')->nullable();
            $table->text('knowledgeConceptFormation')->nullable();
            $table->text('skillsToUseToolsAndMaterials')->nullable();
            $table->text('taskConcept')->nullable();
            $table->text('organizingSpaceAndObjects')->nullable();
            $table->text('adaptation')->nullable();

            // Process Skill //

            // Communication/Interaction skills //

            $table->text('nonVerbalPhysicalContact')->nullable();
            $table->text('nonVerbalEyeContact')->nullable();
            $table->text('nonVerbalGestures')->nullable();
            $table->text('nonVerbalUseOfBody')->nullable();
            $table->text('verbalSpeech')->nullable();
            $table->text('verbalContent')->nullable();
            $table->text('verbalExpressNeeds')->nullable();
            $table->text('verbalConversation')->nullable();
            $table->text('relationsSocialNorms')->nullable();
            $table->text('relationsRapport')->nullable();

            // Communication/Interaction skills //

            // Life Skills //

            $table->text('personalCare')->nullable();
            $table->text('personalSafety')->nullable();
            $table->text('careOfMedication')->nullable();
            $table->text('useOfTransport')->nullable();
            $table->text('domesticSkills')->nullable();
            $table->text('childCareSkills')->nullable();
            $table->text('moneyManagementAndBudgetingSkills')->nullable();
            $table->text('assertiveness')->nullable();
            $table->text('stressManagement')->nullable();
            $table->text('conflictManagement')->nullable();
            $table->text('problemSolvingSkills')->nullable();
            $table->text('preVocationalSkills')->nullable();
            $table->text('vocationalSkills')->nullable();

            // Life Skills //

            // Role performance //

            $table->text('awarenessOfRoles')->nullable();
            $table->text('roleExpectations')->nullable();
            $table->text('roleBalance')->nullable();
            $table->text('competency')->nullable();

            // Role performance //

            // Balanced life style //

            $table->text('timeUseRoutines')->nullable();
            $table->text('habits')->nullable();
            $table->text('mixOfOccupations')->nullable();

            // Balanced life style //

            // Motivation //

            $table->text('activeInvolvement')->nullable();
            $table->text('motivesAndDrives')->nullable();
            $table->text('showsInterest')->nullable();
            $table->text('goalDirectedBehaviour')->nullable();
            $table->text('locusOfControl')->nullable();

            // Motivation //

            // Self esteem //

            $table->text('commitmentToTaskSituation')->nullable();
            $table->text('usingFeedback')->nullable();
            $table->text('selfWorth')->nullable();
            $table->text('attitudeSelfAssurance')->nullable();
            $table->text('attitudeSelfSatisfaction')->nullable();
            $table->text('awarenessOfQualities')->nullable();
            $table->text('socialPresence')->nullable();

            // Self esteem //

            // Affect //

            $table->text('repertoireOfEmotions')->nullable();
            $table->text('emotionControl')->nullable();
            $table->text('moods')->nullable();

            // Affect //

            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->enum('test_type', ['0', '1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_apoms');
    }
};
