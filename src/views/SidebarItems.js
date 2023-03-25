/**
 * Import remote dependencies.
 */
import React from "react";
// Used as const not import, for Loco translate plugin compatibility.
const __ = wp.i18n.__;
import {
    AiOutlineSetting,
} from "react-icons/ai";

/**
 * Import local dependencies
 */
import Settings from "../components/Settings";

const SidebarItems = [
    {
        path: "/",
        element: Settings,
        name: __("Settings", "panel-storm"),
        icon: <AiOutlineSetting/>,
    },
];

export default SidebarItems;
