package ch.rm2014.vogler;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/rating")
public class RatingServlet extends HttpServlet {

	private static final long serialVersionUID = 1L;

	protected void doGet(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {

		try {

			Database database = Database.getInstance();
			Connection connection = database.getConnection();

			int idThread = Integer.parseInt(request.getParameter("id_thread"));
			int idComment = Integer
					.parseInt(request.getParameter("id_comment"));
			String dir = request.getParameter("dir");

			String column = "rating_up";
			if (dir.equals("down")) {
				column = "rating_down";
			}

			PreparedStatement statement = connection
					.prepareStatement("UPDATE comment SET " + column + " = "
							+ column + " + 1 WHERE id_comment = ?");
			statement.setInt(1, idComment);
			statement.execute();

			response.sendRedirect("thread_detail?id=" + idThread);

		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
