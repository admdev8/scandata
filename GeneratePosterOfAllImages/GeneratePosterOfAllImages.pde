
float pageW =           36;
float pageH =           48;
float margin =          1;
int numWide =           24;
int resolution =        72;

String outputFilename = "AllImagesPoster.tiff";
String imageFolder =    "Documents/Scandata/FullResJPGs/";


void setup() {
  size(int(pageW * resolution), int(pageH * resolution));
  margin *= resolution;
  
  // load images
  println("Getting list of images...");
  File imagePath = new File(imageFolder);
  String[] images = imagePath.list();
  
  // load images; what's the image's ratio?
  PImage img = loadImage(imageFolder + images[0]);
  int imgWidth = (int) (width - (margin * 2)) / numWide;
  img.resize(imgWidth, 0);
  int imgHeight = img.height;
  int numHigh = (int) (height - (margin*2)) / imgHeight;
  println("- scaled image dims: " + imgWidth + " x " + imgHeight);
  println("- that gets you " + numWide + " x " + numHigh + " (" + (numWide * numHigh) + ") images");
  
  // draw em!
  println("Drawing images...");
  background(255);
  float x = margin;
  float y = margin;
  for (int i=0; i<images.length; i++) {
    println("- " + (i+1) + "/" + images.length);
    img = loadImage(imageFolder + images[i]);
    image(img, x,y, imgWidth, imgHeight);
    x += imgWidth;
    if (x > width - margin - imgWidth) {
      x = margin;
      y += imgHeight;
    }
    if (y > height - margin - imgHeight) break;
  }
  
  // done, save and quit
  println("Saving...");
  save(outputFilename);
  println("\nDONE!");
  exit();
}


