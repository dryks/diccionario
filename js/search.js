 var options = {

                                    url: function(phrase) {
                                        if (phrase !== "") {
                                            return "https://diccionario.pro/site.php?text=" + phrase + "";
                                        } else {

                                            return "https://diccionario.pro/site.php?text=0";
                                        }
                                    },






                                    getValue: "text",

                                    template: {
                                        type: "links",
                                        fields: {
                                            link: "site"
                                        }
                                    },

                                    list: {
                                        match: {
                                            enabled: false
                                        }
                                    },

                                    theme: "Square"
                                };

                                $("#data-links").easyAutocomplete(options);