/**
 * Import remote dependencies.
 */
import React, {useState, useEffect, useContext} from "react";
import {AiOutlineBell} from "react-icons/ai";
import {BiSupport} from "react-icons/bi";
// Used as const not import, for Loco translate plugin compatibility.
const {__, sprintf} = wp.i18n;

function Header() {
    return (
        <header className="faraz-header container">
            <div className="header-content responsive-wrapper">
                <div className="header-logo">
                    <a href="#">
                        <h2>{__("Panel Storm", "panel-storm")}</h2>
                    </a>
                </div>
                <div className="header-navigation">
                    <nav className="header-navigation-links">
                        <a href="https://wpstorm.ir/" target="_blank">
                            {__("Official Website", "panel-storm")}
                        </a>
                        <a href="https://wpstorm.ir/" target="_blank">
                            {__("Report Issues", "panel-storm")}
                        </a>
                    </nav>
                    <div className="header-navigation-actions">
                        <a
                            href="https://wpstorm.ir/"
                            className="icon-button"
                            target="_blank"
                        >
                            <BiSupport/>
                        </a>
                        {/*<a href="#" className="icon-button">*/}
                        {/*    <AiOutlineBell/>*/}
                        {/*</a>*/}
                    </div>
                </div>
            </div>
        </header>
    );
}

export default Header;
