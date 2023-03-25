/**
 * Import remote dependencies.
 */
import React, {useState, useEffect, useContext} from "react";
import {useImmerReducer} from "use-immer";
import Axios from "axios";
// Used as const not import, for Loco translate plugin compatibility.
const __ = wp.i18n.__;

import DispatchContext from "../DispatchContext";


/**
 * Import local dependencies
 */

function Settings() {
    const appDispatch = useContext(DispatchContext);
    /**
     *
     * First init state.
     *
     */
    const originalState = {
        inputs: {
            apikey: {
                value: "",
                hasErrors: false,
                errorMessage: "",
                onChange: "apikeyChange",
                name: "apikey",
                type: "text",
                placeholder: __("API key", "farazsms"),
                label: __("Your API key:", "farazsms"),
                required: true,
                rules: "apikeyRules",
                checkCount: 0,
                tooltip: __(
                    "To get the access key in your farazsms panel, refer to the web service menu in the access keys section",
                    "farazsms"
                ),
            },
            username: {
                value: "",
                hasErrors: false,
                errorMessage: "",
                onChange: "usernameChange",
                name: "username",
                type: "text",
                placeholder: __("Username", "farazsms"),
                label: __("Username", "farazsms"),
                required: true,
                rules: "usernameRules",
                checkCount: 0,
            },
            password: {
                value: "",
                hasErrors: false,
                errorMessage: "",
                onChange: "passwordChange",
                name: "password",
                type: "text",
                placeholder: __("Password", "farazsms"),
                label: __("Password", "farazsms"),
                required: true,
                rules: "passwordRules",
                checkCount: 0,
            },
            admin_number: {
                value: "",
                hasErrors: false,
                errorMessage: "",
                onChange: "admin_numberChange",
                name: "admin_number",
                type: "text",
                placeholder: __("Admin Number", "farazsms"),
                label: __("Admin Number", "farazsms"),
                required: true,
                rules: "admin_numberRules",
                checkCount: 0,
            },
            from_number: {
                value: "",
                hasErrors: false,
                errorMessage: "",
                onChange: "from_numberChange",
                name: "from_number",
                type: "text",
                placeholder: __("Sender number", "farazsms"),
                label: __("Sender number", "farazsms"),
                required: true,
                rules: "from_numberRules",
            },
            from_number_adver: {
                value: "",
                hasErrors: false,
                errorMessage: "",
                onChange: "from_number_adverChange",
                name: "from_number_adver",
                type: "text",
                placeholder: __("Advertising sender number", "farazsms"),
                label: __("Advertising sender number", "farazsms"),
                rules: "from_number_adverRules",
                tooltip: __(
                    "If you have Enamad, it is suggested that you purchase a dedicated 9000 line for sending web service SMS and sending SMS to customers. Send a support ticket for this.",
                    "farazsms"
                ),
            },
        },
        isFetching: true,
        isSaving: false,
        sendCount: 0,
        sectionName: __("General", "farazsms"),
        ippanelUsername: "",
    };

    function ourReduser(draft, action) {
        switch (action.type) {
            case "fetchComplete":
                draft.inputs.apikey.value = action.value.apikey;
                draft.isFetching = false;
                return;

        }
    }

    const [state, dispatch] = useImmerReducer(ourReduser, originalState);

    /**
     * The settings form created by mapping over originalState as the main state.
     * For every value on inputs rendered a SettingsFormInput.
     *
     * @since 2.0.0
     */
    return (
        <div>
            <h1>Hi From React</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.</p>
        </div>
    );
}

export default Settings;
