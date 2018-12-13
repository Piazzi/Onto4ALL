<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\TipsRelation;
use App\TipClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        $tips_relations = TipsRelation::all();
        $tips_class = TipClass::all();
        return view('index', compact('menus','tips_relations','tips_class')); /* Editor */
    }

    public function save()
    {
                /**
         * Copyright (c) 2006, Gaudenz Alder
         *
         * This server handles two types of POST requests:
         *
         *   - Save requests persist a graph model XML to a local file.
         *     They have an xml and draft (GET) parameter. draft
         *     is optional, the default value for draft is false.
         *   - Show requests convert a display XML to an image
         *     They have an xml and format (GET) paramter.
         *     xml is the mxGraphView XML data, format
         *     is one of html, png or jpg.
         */
        // Includes the mxGraph library
        include_once("resources/views/mxServer.php");

        // Gets the format parameter from the URL
        $format = $_GET["format"];

        // Gets the XML parameter from the POST request
        $xml = stripslashes($_POST["xml"]);

        if (isset($xml))
        {
            // Creates an image for the given format
            if (isset($format))
            {
                // Displays a saveAs dialog on the client
                header("Content-Disposition: attachment; filename=\"diagram.$format\"");
                header("Content-Type: image/$format");
                $image = mxGraphViewImageReader::convert($xml, "#FFFFFF");
                echo mxUtils::encodeImage($image, $format);
            }
            else
            {
                // Stores the xml in a local file
                $ext = "tmp";

                if (!isset($HTTP_GET_VARS["draft"]))
                {
                    $ext = "xml";
                    unlink("diagram.tmp");
                }

                $filename = "diagram.$ext";
                $fh = fopen($filename, "w");
                fputs($fh, stripslashes($xml));
                fclose($fh);
                chmod($filename, 0777);
            }
        }
        else
        {
            // Sends the diagram file to the client if
            // there is a draft (tmp-file).
            $filename = "diagram.tmp";

            if (file_exists($filename))
            {
                // Avoids cache in Firefox
                header("Content-type: text/xml");
                Header("Pragma: no-cache"); #HTTP 1.0
                Header("Cache-control: private, no-cache, no-store");
                Header("Expires: 0");
                $fh=fopen($filename, "r");
                fpassthru($fh);
                fclose($fh);
            }
        }
            }
        }
