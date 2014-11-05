// This code might have some error, just to keep the idea
static byte[] readByteFile(String Pathfile){

	File file = new File(Pathfile);
    FileInputStream fin = null;
    long[][] countMatrix = null;
    try{
        // create FileInputStream object
        fin = new FileInputStream(file);
        
        byte[] bufferFile = new byte[1024];
        
        // Reads up to certain bytes of data from this input stream into an array of bytes
        fin.read(bufferFile);

        return bufferFile;         
    }
    catch (FileNotFoundException e) {
        System.out.println("File not found" + e);
    }
    catch (IOException ioe) {
        System.out.println("Exception while reading file " + ioe);
    }

    finally {
        // close the streams using close method
        try {
            if (fin != null) {
                fin.close();
            }
        }
        catch (IOException ioe) {
            System.out.println("Error while closing stream: " + ioe);
        }
    }
    return bufferFile;
}

public static List<String> readTextFile(String pathFile){
    List<String> text = null;
    FileReader fr = null;
    BufferedReader buffer = null;
    try {
        fr = new FileReader(pathFile);
        buffer = new BufferedReader(fr);
        text = new ArrayList<String>();
        
        String line = buffer.readLine();
        while(line != null){
            text.add(line);
            line = buffer.readLine();
        }
        return text;
    } catch (FileNotFoundException ex) {
        System.err.println("File not found");
    } catch (IOException ex) {
        Logger.getLogger(Project3CS355.class.getName()).log(Level.SEVERE, null, ex);
    }
    finally{
        try {
            if (buffer != null) buffer.close();
            if (fr != null) fr.close();
        } catch (IOException ex) {
            Logger.getLogger(Project3CS355.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    return text;
}