/**
 * Import remote dependencies.
 */
import React, {useState, useReducer, useEffect} from "react";
import {useImmerReducer} from "use-immer";
import {HashRouter, Route, Routes} from "react-router-dom";

const __ = wp.i18n.__;

/**
 * Import local dependencies
 */
// Plugin Context
import StateContext from "./StateContext";
import DispatchContext from "./DispatchContext";
import {ConfirmContextProvider} from "./store/ConfirmContextProvider";
import ConfirmDialog from "./components/ConfirmDialog";
// Plugin Components
import Header from "./components/Header";
import Sidebar from "./components/Sidebar";
import Footer from "./components/Footer";
import FlashMessages from "./views/FlashMessages";
import SidebarItems from "./views/SidebarItems";


function App() {
    const initialState = {
        flashMessages: {
            message: [],
            type: "",
        },
        confirm: {
            show: false,
            text: "",
        },
    };

    function ourReducer(draft, action) {
        switch (action.type) {
            case "flashMessage":
                draft.flashMessages.message.push(action.value.message);
                draft.flashMessages.type = action.value.type;
                return;
            case "ShowConfirm":
                draft.confirm.show = true;
                draft.confirm.text = action.value;
                return;
            case "HideConfirm":
                draft.confirm.show = false;
                draft.confirm.text = action.value;
                return;
        }
    }

    const [state, dispatch] = useImmerReducer(ourReducer, initialState);

    return (
        <HashRouter>
            <StateContext.Provider value={state}>
                <DispatchContext.Provider value={dispatch}>
                    <ConfirmContextProvider>
                        <Header/>
                        <FlashMessages flashMessages={state.flashMessages}/>
                        <ConfirmDialog/>
                        <Sidebar>
                            <Routes>
                                {SidebarItems.map((item, index) => (
                                    <Route
                                        key={index}
                                        path={item.path}
                                        element={<item.element/>}
                                    />
                                ))}
                            </Routes>
                        </Sidebar>
                        <Footer/>
                    </ConfirmContextProvider>
                </DispatchContext.Provider>
            </StateContext.Provider>
        </HashRouter>
    );
}

export default App;
