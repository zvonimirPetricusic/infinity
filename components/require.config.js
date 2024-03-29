var components = {
    "packages": [
        {
            "name": "jquery-validation",
            "main": "jquery-validation-built.js"
        },
        {
            "name": "jquery",
            "main": "jquery-built.js"
        }
    ],
    "shim": {
        "jquery-validation": {
            "deps": [
                "jquery"
            ]
        }
    },
    "baseUrl": "components"
};
if (typeof require !== "undefined" && require.config) {
    require.config(components);
} else {
    var require = components;
}
if (typeof exports !== "undefined" && typeof module !== "undefined") {
    module.exports = components;
}