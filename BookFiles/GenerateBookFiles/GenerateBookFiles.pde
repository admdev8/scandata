
import processing.pdf.*;

/*
GENERATE BOOK
Jeff Thompson | 2015 | www.jeffreythompson.org

*/

float pageW =            8.125;
float pageH =            10.25;
int pdfResolution =      72;
int numPages =           50;

boolean blankFinalPage = false;

String outputFilename =  "../Pages.pdf";
String imageFolder =     "Documents/Scandata/FullResJPGs/";


void setup() {
  size(585, 738);
  //size(int(pageW * pdfResolution), int(pageH * pdfResolution));
  
  // create PDF context to draw in
  println("Creating PDF context...");
  PGraphics pdf = createGraphics(width, height, PDF, outputFilename);
  pdf.beginDraw();
  PGraphicsPDF pdfOutput = (PGraphicsPDF) pdf;

  // add images to book
  println("Adding pages...");
  File imagePath = new File(imageFolder);
  String[] images = imagePath.list();
  if (numPages > images.length) numPages = images.length;
  for (int i=0; i<images.length; i++) {
    println("- " + (i+1) + "/" + numPages);
    PImage image = loadImage(imageFolder + images[i]);
    pdf.image(image, 0,0, width,height);
    if (i == (numPages-1)) break;
    
    pdfOutput = (PGraphicsPDF) pdf;
    pdfOutput.nextPage();
  }
  
  // one more blank page to end book
  if (blankFinalPage) {
    pdfOutput = (PGraphicsPDF) pdf;
    pdfOutput.nextPage();
  }
  
  // done, close PDF and quit
  println("Saving...");
  pdf.dispose();
  pdf.endDraw();
  println("DONE!");
  exit();
}