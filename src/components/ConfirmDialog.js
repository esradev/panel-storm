/**
 * @see https://devrecipes.net/custom-confirm-dialog-with-react-hooks-and-the-context-api/
 */

import React from "react";
import { createPortal } from "react-dom";
import useConfirm from "../hooks/useConfirm";
const __ = wp.i18n.__;

const ConfirmDialog = () => {
    const { onConfirm, onCancel, confirmState } = useConfirm();

    const portalElement = document.getElementById("panel-storm-portal");
    const component = confirmState.show ? (
        <div className="panel-storm-portal-overlay">
            <div className="confirm-dialog">
                <h5>{confirmState?.text && confirmState.text}</h5>
                <div className="confirm-dialog__footer">
                    <div className="btn btn-danger mx-1" onClick={onConfirm}>
                        {__("Yes", "panel-storm")}
                    </div>
                    <div className="btn btn btn-outline-dark mx-1" onClick={onCancel}>
                        {__("No", "Cancel")}
                    </div>
                </div>
            </div>
        </div>
    ) : null;

    return createPortal(component, portalElement);
};
export default ConfirmDialog;
