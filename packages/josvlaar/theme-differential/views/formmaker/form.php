<?php
$view->script('formmaker', 'bixie/formmaker:app/bundle/formmaker.js', ['bixie-fieldtypes']);
?>
<form id="formmaker-form" class="{{ formitem.data.formStyle }} {{ formitem.data.classSfx }}"
      v-validator="form" @submit.prevent="save | valid" v-cloak>

    <h2 v-if="!formitem.data.hide_title">{{ formitem.title }}</h2>

    <div v-if="message">
        {{ message | trans }}</div>

    <div v-if="!thankyou">
        <fieldtypes :fields="fields"
                    :model.sync="submission.data"
                    :form="form"></fieldtypes>

        <recaptcha v-ref:grecaptcha v-if="formitem.data.recaptcha" :sitekey="config.recaptha_sitekey" :formitem="formitem" class="uk-margin"></recaptcha>

        <div class="alert" v-if="error">
            {{ error | trans }}</div>

            <button type="submit">{{ formitem.data.submitButton | trans }}</button>
    </div>
    <div v-else>{{{ thankyou }}}</div>

</form>
