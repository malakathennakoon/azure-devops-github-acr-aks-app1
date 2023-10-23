import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Calendar;
import java.util.Date;
      

public class reg {

    Connection conn;

    public static void main(String[] args)
    {
        new reg();
    }

    public reg(){
        try
        {
            // create our mysql database connection
            Class.forName("com.mysql.jdbc.Driver");
            conn= DriverManager.getConnection("jdbc:mysql://smtrash8.cmbmotdimkl5.ap-southeast-1.rds.amazonaws.com:3306/smartbin?useSSL=false","smtrash8","smartbin");

            UpdateMLBregressionPA_tbl(MLB_PA_count());
			UpdateMLBregressionPL_tbl(MLB_PL_count());
			UpdateMLBregressionGL_tbl(MLB_GL_count());
			UpdateMLBregressionBI_tbl(MLB_BI_count());
            conn.close();

        }
        catch (Exception e)
        {
            System.err.println("Got an exception! ");
            e.printStackTrace();
        }
    }


    public int[] MLB_PA_count()
    {


        try
        {
            // our SQL SELECT query.
            // if you only need a few columns, specify them by name instead of using "*"
            String query = "SELECT * FROM binTotalVolume_tbl";

            // create the java statement
            Statement st = conn.createStatement();

            // execute the query, and get a java resultset
            ResultSet rs = st.executeQuery(query);
            //int n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13,n14,n15=0;
            // (1) create a java int array
            int[] count = new int[15];

            for (int i=0; i<count.length; i++)
            {
                count[i] = 0;
            }

            // iterate through the java resultset
            while (rs.next())
            {

                float volume=(float) rs.getDouble("totalVolume");
                String id = rs.getString("binID");
                String[] parts = id.split("-");

                if(parts[0].equals("MLB"))
                {
                    if(parts[2].equals("PA"))
                    {
                        if((volume>=0)&&(volume<=200000))
                        {
                            count[0]++;
                        }
                        else if((volume>200000)&&(volume<=400000))
                        {
                            count[1]++;
                        }
                        else if((volume>400000)&&(volume<=600000))
                        {
                            count[2]++;
                        }
                        else if((volume>600000)&&(volume<=800000))
                        {
                            count[3]++;
                        }
                        else if((volume>800000)&&(volume<=1000000))
                        {
                            count[4]++;
                        }
                        else if((volume>1000000)&&(volume<=1200000))
                        {
                            count[5]++;
                        }
                        else if((volume>1200000)&&(volume<=1400000))
                        {
                            count[6]++;
                        }
                        else if((volume>1400000)&&(volume<=1600000))
                        {
                            count[7]++;
                        }
                        else if((volume>1600000)&&(volume<=1800000))
                        {
                            count[8]++;
                        }
                        else if((volume>1800000)&&(volume<=2000000))
                        {
                            count[9]++;
                        }
                        else if((volume>2000000)&&(volume<=2200000))
                        {
                            count[10]++;
                        }
                        else if((volume>2200000)&&(volume<=2400000))
                        {
                            count[11]++;
                        }
                        else if((volume>2400000)&&(volume<=2600000))
                        {
                            count[12]++;
                        }
                        else if((volume>2600000)&&(volume<=2800000))
                        {
                            count[13]++;
                        }
                        else
                        {
                            count[14]++;
                        }
                    }
                }
				restbinTotalVolume_tbl(id);
            }
            st.close();
            return count;
        }
        catch (SQLException ex)
        {
            System.err.println(ex.getMessage());
            return null;
        }


    }

    public void UpdateMLBregressionPA_tbl(int[] count)
    {
        java.util.Date date= new Date();
        Calendar cal = Calendar.getInstance();
        cal.setTime(date);
        //int month = cal.get(Calendar.MONTH);
        int month=7;

        try {
        String query = "UPDATE MLBregressionPA_tbl SET 0k_200k=(?),200k_400k=(?),400k_600k=(?),600k_800k=(?),800k_1000k=(?),1000k_1200k=(?),1200k_1400k=(?),1400k_1600k=(?),1600k_1800k=(?),1800k_2000k=(?),2000k_2200k=(?),2200k_2400k=(?),2400k_2600k=(?),2600k_2800k=(?),2800k_3000k=(?) WHERE month = (?)";
            PreparedStatement preparedStmt = conn.prepareStatement(query);
            preparedStmt.setInt(1,count[0]);
            preparedStmt.setInt(2,count[1]);
            preparedStmt.setInt(3,count[2]);
            preparedStmt.setInt(4,count[3]);
			preparedStmt.setInt(5,count[4]);
			preparedStmt.setInt(6,count[5]);
			preparedStmt.setInt(7,count[6]);
			preparedStmt.setInt(8,count[7]);
			preparedStmt.setInt(9,count[8]);
			preparedStmt.setInt(10,count[9]);
			preparedStmt.setInt(11,count[10]);
			preparedStmt.setInt(12,count[11]);
			preparedStmt.setInt(13,count[12]);
			preparedStmt.setInt(14,count[13]);
			preparedStmt.setInt(15,count[14]);
            preparedStmt.setInt(16,month-1);
        // execute the java preparedstatement
            preparedStmt.executeUpdate();

    }

        catch (Exception e)
    {
        e.printStackTrace();
    }

	}
	
	  public int[] MLB_PL_count()
    {


        try
        {
            // our SQL SELECT query.
            // if you only need a few columns, specify them by name instead of using "*"
            String query = "SELECT * FROM binTotalVolume_tbl";

            // create the java statement
            Statement st = conn.createStatement();

            // execute the query, and get a java resultset
            ResultSet rs = st.executeQuery(query);
            //int n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13,n14,n15=0;
            // (1) create a java int array
            int[] count = new int[15];

            for (int i=0; i<count.length; i++)
            {
                count[i] = 0;
            }

            // iterate through the java resultset
            while (rs.next())
            {

                float volume=(float) rs.getDouble("totalVolume");
                String id = rs.getString("binID");
                String[] parts = id.split("-");

                if(parts[0].equals("MLB"))
                {
                    if(parts[2].equals("PL"))
                    {
                        if((volume>=0)&&(volume<=200000))
                        {
                            count[0]++;
                        }
                        else if((volume>200000)&&(volume<=400000))
                        {
                            count[1]++;
                        }
                        else if((volume>400000)&&(volume<=600000))
                        {
                            count[2]++;
                        }
                        else if((volume>600000)&&(volume<=800000))
                        {
                            count[3]++;
                        }
                        else if((volume>800000)&&(volume<=1000000))
                        {
                            count[4]++;
                        }
                        else if((volume>1000000)&&(volume<=1200000))
                        {
                            count[5]++;
                        }
                        else if((volume>1200000)&&(volume<=1400000))
                        {
                            count[6]++;
                        }
                        else if((volume>1400000)&&(volume<=1600000))
                        {
                            count[7]++;
                        }
                        else if((volume>1600000)&&(volume<=1800000))
                        {
                            count[8]++;
                        }
                        else if((volume>1800000)&&(volume<=2000000))
                        {
                            count[9]++;
                        }
                        else if((volume>2000000)&&(volume<=2200000))
                        {
                            count[10]++;
                        }
                        else if((volume>2200000)&&(volume<=2400000))
                        {
                            count[11]++;
                        }
                        else if((volume>2400000)&&(volume<=2600000))
                        {
                            count[12]++;
                        }
                        else if((volume>2600000)&&(volume<=2800000))
                        {
                            count[13]++;
                        }
                        else
                        {
                            count[14]++;
                        }
                    }
                }
				restbinTotalVolume_tbl(id);
            }
            st.close();
            return count;
        }
        catch (SQLException ex)
        {
            System.err.println(ex.getMessage());
            return null;
        }


    }

    public void UpdateMLBregressionPL_tbl(int[] count)
    {
        java.util.Date date= new Date();
        Calendar cal = Calendar.getInstance();
        cal.setTime(date);
        //int month = cal.get(Calendar.MONTH);
        int month=7;

        try {
        String query = "UPDATE MLBregressionPL_tbl SET 0k_200k=(?),200k_400k=(?),400k_600k=(?),600k_800k=(?),800k_1000k=(?),1000k_1200k=(?),1200k_1400k=(?),1400k_1600k=(?),1600k_1800k=(?),1800k_2000k=(?),2000k_2200k=(?),2200k_2400k=(?),2400k_2600k=(?),2600k_2800k=(?),2800k_3000k=(?) WHERE month = (?)";
            PreparedStatement preparedStmt = conn.prepareStatement(query);
            preparedStmt.setInt(1,count[0]);
            preparedStmt.setInt(2,count[1]);
            preparedStmt.setInt(3,count[2]);
            preparedStmt.setInt(4,count[3]);
			preparedStmt.setInt(5,count[4]);
			preparedStmt.setInt(6,count[5]);
			preparedStmt.setInt(7,count[6]);
			preparedStmt.setInt(8,count[7]);
			preparedStmt.setInt(9,count[8]);
			preparedStmt.setInt(10,count[9]);
			preparedStmt.setInt(11,count[10]);
			preparedStmt.setInt(12,count[11]);
			preparedStmt.setInt(13,count[12]);
			preparedStmt.setInt(14,count[13]);
			preparedStmt.setInt(15,count[14]);
            preparedStmt.setInt(16,month-1);
        // execute the java preparedstatement
            preparedStmt.executeUpdate();

    }

        catch (Exception e)
    {
        e.printStackTrace();
    }

	}
	
	  public int[] MLB_GL_count()
    {


        try
        {
            // our SQL SELECT query.
            // if you only need a few columns, specify them by name instead of using "*"
            String query = "SELECT * FROM binTotalVolume_tbl";

            // create the java statement
            Statement st = conn.createStatement();

            // execute the query, and get a java resultset
            ResultSet rs = st.executeQuery(query);
            //int n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13,n14,n15=0;
            // (1) create a java int array
            int[] count = new int[15];

            for (int i=0; i<count.length; i++)
            {
                count[i] = 0;
            }

            // iterate through the java resultset
            while (rs.next())
            {

                float volume=(float) rs.getDouble("totalVolume");
                String id = rs.getString("binID");
                String[] parts = id.split("-");

                if(parts[0].equals("MLB"))
                {
                    if(parts[2].equals("GL"))
                    {
                        if((volume>=0)&&(volume<=200000))
                        {
                            count[0]++;
                        }
                        else if((volume>200000)&&(volume<=400000))
                        {
                            count[1]++;
                        }
                        else if((volume>400000)&&(volume<=600000))
                        {
                            count[2]++;
                        }
                        else if((volume>600000)&&(volume<=800000))
                        {
                            count[3]++;
                        }
                        else if((volume>800000)&&(volume<=1000000))
                        {
                            count[4]++;
                        }
                        else if((volume>1000000)&&(volume<=1200000))
                        {
                            count[5]++;
                        }
                        else if((volume>1200000)&&(volume<=1400000))
                        {
                            count[6]++;
                        }
                        else if((volume>1400000)&&(volume<=1600000))
                        {
                            count[7]++;
                        }
                        else if((volume>1600000)&&(volume<=1800000))
                        {
                            count[8]++;
                        }
                        else if((volume>1800000)&&(volume<=2000000))
                        {
                            count[9]++;
                        }
                        else if((volume>2000000)&&(volume<=2200000))
                        {
                            count[10]++;
                        }
                        else if((volume>2200000)&&(volume<=2400000))
                        {
                            count[11]++;
                        }
                        else if((volume>2400000)&&(volume<=2600000))
                        {
                            count[12]++;
                        }
                        else if((volume>2600000)&&(volume<=2800000))
                        {
                            count[13]++;
                        }
                        else
                        {
                            count[14]++;
                        }
                    }
                }
			restbinTotalVolume_tbl(id);
            }
            st.close();
            return count;
        }
        catch (SQLException ex)
        {
            System.err.println(ex.getMessage());
            return null;
        }


    }

    public void UpdateMLBregressionGL_tbl(int[] count)
    {
        java.util.Date date= new Date();
        Calendar cal = Calendar.getInstance();
        cal.setTime(date);
        //int month = cal.get(Calendar.MONTH);
        int month=7;

        try {
        String query = "UPDATE MLBregressionGL_tbl SET 0k_200k=(?),200k_400k=(?),400k_600k=(?),600k_800k=(?),800k_1000k=(?),1000k_1200k=(?),1200k_1400k=(?),1400k_1600k=(?),1600k_1800k=(?),1800k_2000k=(?),2000k_2200k=(?),2200k_2400k=(?),2400k_2600k=(?),2600k_2800k=(?),2800k_3000k=(?) WHERE month = (?)";
            PreparedStatement preparedStmt = conn.prepareStatement(query);
            preparedStmt.setInt(1,count[0]);
            preparedStmt.setInt(2,count[1]);
            preparedStmt.setInt(3,count[2]);
            preparedStmt.setInt(4,count[3]);
			preparedStmt.setInt(5,count[4]);
			preparedStmt.setInt(6,count[5]);
			preparedStmt.setInt(7,count[6]);
			preparedStmt.setInt(8,count[7]);
			preparedStmt.setInt(9,count[8]);
			preparedStmt.setInt(10,count[9]);
			preparedStmt.setInt(11,count[10]);
			preparedStmt.setInt(12,count[11]);
			preparedStmt.setInt(13,count[12]);
			preparedStmt.setInt(14,count[13]);
			preparedStmt.setInt(15,count[14]);
            preparedStmt.setInt(16,month-1);
        // execute the java preparedstatement
            preparedStmt.executeUpdate();

    }

        catch (Exception e)
    {
        e.printStackTrace();
    }

	}
	
	  public int[] MLB_BI_count()
    {


        try
        {
            // our SQL SELECT query.
            // if you only need a few columns, specify them by name instead of using "*"
            String query = "SELECT * FROM binTotalVolume_tbl";

            // create the java statement
            Statement st = conn.createStatement();

            // execute the query, and get a java resultset
            ResultSet rs = st.executeQuery(query);
            //int n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13,n14,n15=0;
            // (1) create a java int array
            int[] count = new int[15];

            for (int i=0; i<count.length; i++)
            {
                count[i] = 0;
            }

            // iterate through the java resultset
            while (rs.next())
            {

                float volume=(float) rs.getDouble("totalVolume");
                String id = rs.getString("binID");
                String[] parts = id.split("-");

                if(parts[0].equals("MLB"))
                {
                    if(parts[2].equals("BI"))
                    {
                        if((volume>=0)&&(volume<=200000))
                        {
                            count[0]++;
                        }
                        else if((volume>200000)&&(volume<=400000))
                        {
                            count[1]++;
                        }
                        else if((volume>400000)&&(volume<=600000))
                        {
                            count[2]++;
                        }
                        else if((volume>600000)&&(volume<=800000))
                        {
                            count[3]++;
                        }
                        else if((volume>800000)&&(volume<=1000000))
                        {
                            count[4]++;
                        }
                        else if((volume>1000000)&&(volume<=1200000))
                        {
                            count[5]++;
                        }
                        else if((volume>1200000)&&(volume<=1400000))
                        {
                            count[6]++;
                        }
                        else if((volume>1400000)&&(volume<=1600000))
                        {
                            count[7]++;
                        }
                        else if((volume>1600000)&&(volume<=1800000))
                        {
                            count[8]++;
                        }
                        else if((volume>1800000)&&(volume<=2000000))
                        {
                            count[9]++;
                        }
                        else if((volume>2000000)&&(volume<=2200000))
                        {
                            count[10]++;
                        }
                        else if((volume>2200000)&&(volume<=2400000))
                        {
                            count[11]++;
                        }
                        else if((volume>2400000)&&(volume<=2600000))
                        {
                            count[12]++;
                        }
                        else if((volume>2600000)&&(volume<=2800000))
                        {
                            count[13]++;
                        }
                        else
                        {
                            count[14]++;
                        }
                    }
                }
			restbinTotalVolume_tbl(id);
            }
            st.close();
            return count;
        }
        catch (SQLException ex)
        {
            System.err.println(ex.getMessage());
            return null;
        }


    }

    public void UpdateMLBregressionBI_tbl(int[] count)
    {
        java.util.Date date= new Date();
        Calendar cal = Calendar.getInstance();
        cal.setTime(date);
        //int month = cal.get(Calendar.MONTH);
        int month=7;

        try {
        String query = "UPDATE MLBregressionBI_tbl SET 0k_200k=(?),200k_400k=(?),400k_600k=(?),600k_800k=(?),800k_1000k=(?),1000k_1200k=(?),1200k_1400k=(?),1400k_1600k=(?),1600k_1800k=(?),1800k_2000k=(?),2000k_2200k=(?),2200k_2400k=(?),2400k_2600k=(?),2600k_2800k=(?),2800k_3000k=(?) WHERE month = (?)";
            PreparedStatement preparedStmt = conn.prepareStatement(query);
            preparedStmt.setInt(1,count[0]);
            preparedStmt.setInt(2,count[1]);
            preparedStmt.setInt(3,count[2]);
            preparedStmt.setInt(4,count[3]);
			preparedStmt.setInt(5,count[4]);
			preparedStmt.setInt(6,count[5]);
			preparedStmt.setInt(7,count[6]);
			preparedStmt.setInt(8,count[7]);
			preparedStmt.setInt(9,count[8]);
			preparedStmt.setInt(10,count[9]);
			preparedStmt.setInt(11,count[10]);
			preparedStmt.setInt(12,count[11]);
			preparedStmt.setInt(13,count[12]);
			preparedStmt.setInt(14,count[13]);
			preparedStmt.setInt(15,count[14]);
            preparedStmt.setInt(16,month-1);
        // execute the java preparedstatement
            preparedStmt.executeUpdate();

    }

        catch (Exception e)
    {
        e.printStackTrace();
    }

	}

	public void restbinTotalVolume_tbl(String bin)
	{
		 try {
        String query = "UPDATE binTotalVolume_tbl SET totalVolume=(?) WHERE binID = (?)";
            PreparedStatement preparedStmt = conn.prepareStatement(query);
            preparedStmt.setInt(1,0);
            preparedStmt.setString(2,bin);
        // execute the java preparedstatement
            preparedStmt.executeUpdate();

    }

        catch (Exception e)
    {
        e.printStackTrace();
    }
	}
}
