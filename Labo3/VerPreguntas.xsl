<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <body>
  <h2>Listado de preguntas</h2>
  <table border="1" width="100%">
    <tr bgcolor="#9acd32">
      <th>Enunciado</th>
      <th>Correcta</th>
	  <th>Incorrectas</th>
	  <th>Complejidad</th>
	  <th>Tema</th>
    </tr>
    <xsl:for-each select="assessmentItems/assessmentItem">
    <tr>
      <td><xsl:value-of select="itemBody/p"/></td>
      <td><xsl:value-of select="correctResponse/value"/></td>
	  <td><xsl:value-of select="incorrectResponses"/></td>
	  <td><xsl:value-of select="@complexity"/></td>
	  <td><xsl:value-of select="@subject"/></td>
    </tr>
    </xsl:for-each>
  </table>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>