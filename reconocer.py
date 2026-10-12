import sys
import os
import json
import cv2
import face_recognition as fr
import numpy as np

# Configurar salida estandar a UTF-8 para evitar errores con tildes
sys.stdout.reconfigure(encoding='utf-8')

def main():
    try:
        # Argumentos recibidos desde Laravel
        if len(sys.argv) < 3:
            print(json.dumps({"error": "Faltan argumentos"}))
            sys.exit(1)

        path_imagen_input = sys.argv[1]   # La foto temporal de la webcam
        path_base_biometricos = sys.argv[2] # La carpeta donde estan las fotos guardadas (IDs)

        # 1. Cargar la imagen de la webcam
        if not os.path.exists(path_imagen_input):
            print(json.dumps({"error": "Imagen temporal no encontrada"}))
            sys.exit(1)

        img_input = cv2.imread(path_imagen_input)
        if img_input is None:
            print(json.dumps({"error": "No se pudo leer la imagen"}))
            sys.exit(1)

        # Convertir a RGB y obtener encoding
        rgb_input = cv2.cvtColor(img_input, cv2.COLOR_BGR2RGB)
        encodings_input = fr.face_encodings(rgb_input)

        # Si no hay cara en la webcam
        if len(encodings_input) == 0:
            print(json.dumps({"match": False, "mensaje": "No se detectó ningún rostro en la cámara"}))
            sys.exit(0)

        encoding_desconocido = encodings_input[0]

        # 2. Buscar coincidencia en las carpetas
        mejor_match_id = None
        mejor_distancia = 1.0
        umbral = 0.50  # Mientras más bajo, más estricto (0.6 es el estándar, 0.5 es más seguro)

        # Recorremos las carpetas (cada carpeta es el ID de una persona)
        if os.path.exists(path_base_biometricos):
            nombres_carpetas = os.listdir(path_base_biometricos)

            for id_persona in nombres_carpetas:
                ruta_carpeta = os.path.join(path_base_biometricos, id_persona)

                if os.path.isdir(ruta_carpeta):
                    fotos = os.listdir(ruta_carpeta)

                    # Probamos con las fotos de esa persona
                    for foto in fotos:
                        ruta_foto = os.path.join(ruta_carpeta, foto)

                        # Cargar foto guardada
                        try:
                            img_db = fr.load_image_file(ruta_foto)
                            encodings_db = fr.face_encodings(img_db)

                            if len(encodings_db) > 0:
                                encoding_conocido = encodings_db[0]

                                # Comparar
                                distancia = fr.face_distance([encoding_conocido], encoding_desconocido)[0]

                                if distancia < mejor_distancia:
                                    mejor_distancia = distancia
                                    mejor_match_id = id_persona
                        except:
                            continue # Si una foto falla, seguimos con la siguiente

        # 3. Resultado final
        confianza = (1 - mejor_distancia) * 100

        if mejor_match_id and mejor_distancia < umbral:
            print(json.dumps({
                "match": True,
                "id_persona": mejor_match_id,
                "confianza": round(confianza, 2)
            }))
        else:
            print(json.dumps({
                "match": False,
                "mensaje": "Rostro no reconocido",
                "confianza": round(confianza, 2)
            }))

    except Exception as e:
        print(json.dumps({"error": str(e)}))

if __name__ == "__main__":
    main()
