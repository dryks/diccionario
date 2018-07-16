 var options = {

                                    url: function(phrase) {
                                        if (phrase !== "") {
                                            return "http://diccionario.pro/site.php?text=" + phrase + "";
                                        } else {

                                            return "http://diccionario.pro/site.php?text=0";
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