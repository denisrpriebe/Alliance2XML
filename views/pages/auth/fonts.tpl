<[extends file="../../layout/app.tpl"]>

<[block name="page-title"]><[Config::application('name')]> : : Fonts<[/block]>

<[block name="page-script"]>
    <script>
        $(document).ready(function () {

            $('#fontsTable').DataTable({
                "aLengthMenu": [10, 15, 20],
                "order": [0, "asc"],
                "pagingType": "simple",
                "language": {
                    "lengthMenu": "Display _MENU_ fonts per page",
                    "zeroRecords": "No fonts found for that search.",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    searchPlaceholder: "..."
                }
            });

            /**
             * Add new font Form Validation
             *
             */
            $('#addFontForm').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    code: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter the font code.'
                            },
                            stringLength: {
                                min: 1,
                                max: 3,
                                message: 'The font code must be between 1 and 3 characters long.'
                            }
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter the font name.'
                            }
                        }
                    },
                    roman_id: {
                        validators: {
                            integer: {
                                message: 'The roman id must be a number.'
                            }
                        }
                    },
                    use_default: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a use default option.'
                            }
                        }
                    }
                }
            }).on('success.form.fv', function (e) {
                $('#addFontBtn').addClass('m-progress');
            });

        });
    </script>
<[/block]>

<[block name="page-content"]>

    <div class="animsition">

        <[include file="../layout/partials/navbar.tpl"]>

        <div class="container clear-nav">

            <[include file="../layout/partials/alerts.tpl"]>

            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1>Fonts</h1>
                        <p>Fonts that are used by the Alliance2XML process may be added and configured here.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-font"></span> Available Fonts
                            <div class="btn-group pull-right">
                                <button type="button" data-toggle="modal" data-target="#addFontModal" class="btn btn-primary btn-xs">
                                    <span class="glyphicon glyphicon-plus-sign"></span> Add Font
                                </button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="fontsTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Roman ID</th>
                                        <th>Use Default</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <[foreach from=$fonts item=font]>
                                        <tr>
                                            <td><[$font->id]></td>
                                            <td><[$font->code]></td>
                                            <td><[$font->name]></td>
                                            <td><[$font->roman_id]></td>
                                            <td><[$font->use_default]></td>
                                        </tr>
                                    <[/foreach]>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Add Font Modal -->
    <div id="addFontModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post" action="<[Route::to('add-font')]>" id="addFontForm">                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Font</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Font Code:</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Font Code">
                        </div>
                        <div class="form-group">
                            <label for="name">Font Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Font Name">
                        </div>
                        <div class="form-group">
                            <label for="romanId">Roman ID:</label>
                            <input type="number" class="form-control" id="romanId" name="roman_id" placeholder="Roman ID">
                        </div>
                        <div class="form-group">
                            <label for="useDefault">Use Default:</label>
                            <select class="form-control" id="useDefault" name="use_default">
                                <option>0</option>
                                <option>1</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="addFontBtn" type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-floppy-disk"></span> Save
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<[/block]>

